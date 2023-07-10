<?php

namespace App\Controller;

use DateTime;
use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        //dd($posts->findAll());//muestra todos los datos
        //dd($posts->find(3));
        //dd($posts->findOneBy(['title'=> 'Welcome to US!']));

        /* $microPost = new MicroPost();
        $microPost->setTitle('It comes from controller');
        $microPost->setText('Hi!');
        $microPost->setCreated(new DateTime()); */
        /* $microPost = $posts->find(3);
        $posts->remove($microPost, true); */
        
        return $this->render('micro_post/index.html.twig', [
            'posts' => $posts->findAll(),
        ]);
    }
    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response
    {
        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('micro-post/add', name: 'app_micro_post_add', priority: 2)]
    public function add(): Response
    {
        $microPost = new MicroPost();
        $form = $this->createFormBuilder($microPost)
         ->add('title')
         ->add('text')
         ->add('submit', SubmitType:: class, ['label'=>'Save'])
         ->getForm();

        return $this->renderForm(
            'micro_post/add.html.twig',
            [
                'form'=> $form
            ]
            );
    }
}
