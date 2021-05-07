<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recipe;

class HomeScreenController extends AbstractController
{
    /**
     * @Route("/recipes/add", name="add_new_recipe")
     */
    public function addRecipe(){
        $entityManager = $this->getDoctrine()->getManager();

        $newRecipe = new Recipe();
        $newRecipe->setName('Omelette');
        $newRecipe->setIngredients('eggs, oil');
        $newRecipe->setDifficulty('easy');

        $newRecipe1 = new Recipe();
        $newRecipe1->setName('waffle');
        $newRecipe1->setIngredients('eggs, oil, flour, butter, sugar');
        $newRecipe1->setDifficulty('medium');

        $entityManager->persist($newRecipe);
        $entityManager->persist($newRecipe1);

        $entityManager->flush();

        return new Response('trying to add new recipe...' . $newRecipe1->getId() . $newRecipe->getId());
    }

    /**
     * @Route("/recipe/all", name="get_all_recipe")
     */

    public function getAllRecipe(){
        $recipes=$this->getDoctrine()->getRepository(Recipe::class)->findAll();
        $response=[];

foreach($recipes as $recipe){
    $response[]=array(
        'name'=>$recipe->getName(),
        'ingredients'=>$recipe->getIngredients(),
        'difficulty'=>$recipe->getDifficulty()
    );
}
        return $this->json($response);



    }

//    /**
//     * @Route("/recipe/{id}", name="get_id_recipe", methods={"GET"})
//     */
//    public function recipe($id, Request $request)
//    {
//        return $this->json([
//            'message' => 'Requesting recipe with id' . $id,
//            'name' => $request->query->get('name'),
//            'ingredients'=>$request->query->get( key: 'ingredients'),
//            'difficulty'=>$request->query->get(key: 'difficulty')
//        ]);
//
//    }

    /**
     * @Route("/recipe/add", name="add_new_query_recipe")
     */
    public function recipe(Request $request)
    {

        $name=$request->query->get('name');
        $ingredients=$request->query->get( key: 'ingredients');
        $difficulty=$request->query->get(key: 'difficulty');


        $entityManager = $this->getDoctrine()->getManager();

        $newRecipe = new Recipe();
        $newRecipe->setName($name);
        $newRecipe->setIngredients($ingredients);
        $newRecipe->setDifficulty($difficulty);



        $entityManager->persist($newRecipe);


        $entityManager->flush();

        return new Response('trying to add new recipe...' . $newRecipe->getId());



    }








}


