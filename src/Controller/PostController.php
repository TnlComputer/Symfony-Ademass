<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
  private $en;

  public function __construct(EntityManagerInterface $en)
  {
    $this->en = $en;
  }

  #[Route('/post/{id}', name: 'app_post')]
  public function index($id): Response
  {
    $posts = $this->en->getRepository(Post::class)->find($id);
    $customPost = $this->en->getRepository(Post::class)->findPost($id);
    return $this->render('post/index.html.twig', [
      'posts' => $posts,
      'customPost' => $customPost
    ]);
  }
}