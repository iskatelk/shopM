<?php

namespace App\Controller;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="app_account")
     */
    public function index(Request $request,EntityManagerInterface $em)
	{
		$customer = $request->getSession()->get(
            Security::LAST_USERNAME
        );
		$repository = $em->getRepository(Order::class);
        $orderDetails = $repository->findOneBy(array
		      ('email' => $customer),array('orderNumber' => 'DESC')
         );
		//dd($orderDetails);
        return $this->render('account/account.html.twig', [
           // 'controller_name' => 'AccountController',
		   'orderDetails' => $orderDetails,
        ]);
    }
}
