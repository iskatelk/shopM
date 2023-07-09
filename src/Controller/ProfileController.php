<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $customer = $request->getSession()->get(
            Security::LAST_USERNAME
        );
        $repository = $em->getRepository(User::class);
        $userDetails = $repository->findOneBy(array('email'=>$customer));

        if(isset($_POST['name'])) {
            $queryBuilder = $em->createQueryBuilder();
            $query = $queryBuilder->update('App:User', 'u')
                ->set('u.customer', ':userName')
                ->set('u.phone', ':phone')
                ->set('u.password', ':password')
                ->where('u.email = :email')
                ->setParameter('userName', $_POST['name'])
                ->setParameter('phone', $_POST['phone'])
                ->setParameter('password', $_POST['password'])
                ->setParameter('email', $customer)
                ->getQuery();
            $result = $query->execute();
        }
        return $this->render('profile/profile.html.twig', [
           // 'controller_name' => 'ProfileController',
            'userDetails' => $userDetails,
        ]);
    }
}
