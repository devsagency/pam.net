<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ClassController
 * @package App\Controller
 */
class ClassController extends MainController
{
    /**
     * @var array
     */
    private $class = [];

    public function defaultMethod()
    {
        $this->redirect("home");
    }

    private function setClassData()
    {
        $this->class["class"]       = (string) trim($this->getPost("class"));
        $this->class["path"]        = (string) trim($this->getPost("path"));
        $this->class["parameters"]  = (string) trim($this->getPost("parameters"));
        $this->class["extends"]     = (string) trim($this->getPost("extends"));
        $this->class["detail"]      = (string) trim($this->getPost("detail"));

        $this->class["abstract"] = (int) $this->getPost("abstract");
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createMethod()
    {
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        if ($this->checkArray($this->getPost())) {
            $this->setClassData();

            ModelFactory::getModel("Class")->createData($this->class);

            $this->setSession([
                "message"   => "New Class successfully created !", 
                "type"      => "green"
            ]);

            $this->redirect("admin");
        }

        return $this->render("back/createClass.twig");
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function updateMethod()
    {
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        if ($this->checkArray($this->getPost())) {
            $this->setClassData();

            ModelFactory::getModel("Class")->updateData(
                $this->getGet("id"), 
                $this->class
            );

            $this->setSession([
                "message"   => "Successful modification of the selected Class !", 
                "type"      => "blue"
            ]);

            $this->redirect("admin");
        }

        $class = ModelFactory::getModel("Class")->readData($this->getGet("id"));

        return $this->render("back/updateClass.twig", ["class" => $class]);
    }

    public function deleteMethod()
    {
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        $properties = ModelFactory::getModel("Property")->listData(
            $this->getGet("id"), 
            "class_id"
        );

        foreach ($properties as $property) {
            ModelFactory::getModel("Property")->deleteData($property["id"]);
        }

        $methods = ModelFactory::getModel("Method")->listData(
            $this->getGet("id"), 
            "class_id"
        );

        foreach ($methods as $method) {
            ModelFactory::getModel("Method")->deleteData($method["id"]);
        }

        ModelFactory::getModel("Class")->deleteData($this->getGet("id"));

        $this->setSession([
            "message"   => "Class permanently deleted !", 
            "type"      => "red"
        ]);

        $this->redirect("admin");

    }
}