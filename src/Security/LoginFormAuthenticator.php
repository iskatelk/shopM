<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\HttpFoundation\Session\Session;


class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;
    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(
        UserRepository $userRepository,
         UrlGeneratorInterface $urlGenerator,
        //  CsrfTokenManagerInterface $csrfTokenManager,
        //   UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->userRepository = $userRepository;
          $this->urlGenerator = $urlGenerator;
        //  $this->csrfTokenManager = $csrfTokenManager;
        //  $this->passwordEncoder = $passwordEncoder;
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate('app_login');
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'app_login' && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
            //   'csrf_token' => $request->request->get('_csrf_token'),
        ];

           $request->getSession()->set(
               Security::LAST_USERNAME,
               $credentials['email']
           );

           return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /*   $csrfToken = new CsrfToken('authenticate', $credentials['csrf_token']);
           if (! $this->csrfTokenManager->isTokenValid($csrfToken)) {
               throw new InvalidCsrfTokenException();
           }

           if ($credentials['email'] === 'admin@exmaple.com') {
               throw new CustomUserMessageAuthenticationException('Вы не зарегистрированны');
           }*/

        return $this->userRepository->findOneBy(['email' => $credentials['email']]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
        return $credentials['password'] == $user->getPassword();
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        //  return new RedirectResponse($this->urlGenerator->generate('app_homepage'));
		$session = new Session();
		$orderConfirm = $session->get('orderConfirm');
		$customer = $request->getSession()->get(
            Security::LAST_USERNAME
        );
		 if($customer == 'admin@example.com'){
			return new RedirectResponse('/admin');
		}else if(isset($orderConfirm)){
		   return new RedirectResponse('/order');
		} else {
			return new RedirectResponse('/account');
		}
		
		
    }

}
