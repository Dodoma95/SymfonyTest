<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dodoma")
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="homepage")
     * @return Response
     */
    public function index(){
        return $this->render("home/index.html.twig", ["message"=>"Hello Symfony"]);
    }

    /**
     * regex -> de 0 a 9 possible et max suite de 1 a 3 donc 1 a 100 par exemple [0-9]{1,3}
     * regex plus complexe pour limiter age de 1 a 120
     * @Route("/hello/{name}/{age}", requirements={"age":"[1-9][0-9]?|11[0-9]|120|10[0-9]"})
     * @param $age
     * @param $name
     * @return Response
     */
    public function hello($age, $name){
        return new Response("<h1>Hello $name vous avez $age ans</h1>");
    }

    /**
     * abstractcontroller permet d'utiliser this et la méthode render qui retourne un object response
     * les view sont dans les templates
     * @Route("/good-afternoon/{name}")
     * @param $name
     * @return Response
     */
    public function goodAfternoon($name){
        return $this->render("home/afternoon.html.twig",
        [
            "name" => $name,
            "fruitList" => ["Pommes", "Oranges", "Grenades"]
        ]);
    }

}