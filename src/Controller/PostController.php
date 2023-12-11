<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
  private $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }
  #[Route('/', name: 'app_post')]
  public function index(Request $request): Response
  {
    $post = new Post();
    $posts =  $this->em->getRepository(Post::class)->findAllPost();

    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $url = str_replace( " ", "-", $form->get('title')->getData());
      $post->setUrl($url);
      $user = $this->em->getRepository(User::class)->find(1);
      $post->setUser($user);
      $this->em->persist($post);
      $this->em->flush();
      return $this->redirectToRoute('app_post');
    }

    return $this->render('post/index.html.twig', [
        'form' => $form->createView(),
        'posts' => $posts
    ]);
  }
}