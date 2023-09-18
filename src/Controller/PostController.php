<?php

namespace App\Controller;

use DateTime;
use App\Entity\Post;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
  private $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  #[Route('/post/{id}', name: 'app_post')]
  public function index($id): Response
  {
    $posts = $this->em->getRepository(Post::class)->find($id);
    $custom_post = $this->em->getRepository(Post::class)->findPost($id);
    return $this->render('post/index.html.twig', [
      'posts' => $posts,
      'custom_post' => $custom_post
    ]);
  }

  #[Route('/insert/post', name: 'insert_post')]
  public function insert()
  {
    $post = new Post(title: 'Mi post insertado', type: 'opinion', description: 'Hola Mundo', file: 'holita.jpg', url: 'hola mundo');
    $user = $this->em->getRepository(User::class)->find(id: 1);
    $post->setUser($user);

    $this->em->persist($post);
    $this->em->flush();
    return new JsonResponse(['Sucsess' => true]);
  }
  #[Route('/update/post', name: 'insert_post')]
  public function update()
  {
    $post = $this->em->getRepository(Post::class)->find(id: 2);
    $post->setTitle('Mi post actualizado');
    $this->em->flush();
    return new JsonResponse(['Sucsess' => true]);
  }

  #[Route('/remove/post', name: 'insert_post')]
  public function remove()
  {
    $post = $this->em->getRepository(Post::class)->find(id: 2);
    $this->em->remove($post);
    $this->em->flush();
    return new JsonResponse(['Sucsess' => true]);
  }
}