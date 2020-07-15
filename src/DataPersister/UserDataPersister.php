<?php


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;

use Doctrine\ORM\EntityManagerInterface;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class UserDataPersister implements DataPersisterInterface, ContainerAwareCommand{

    private $entityManager;
    private $userPasswordEncoder;
    private $emailVerifier;

    public function __construct(EntityManagerInterface $entityManager,UserPasswordEncoderInterface $userPasswordEncoder, EmailVerifier $emailVerifier)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
        $this->emailVerifier = $emailVerifier;
    }

    public function supports($data): bool
    {
        return $data instanceof User;
    }

    /**
     * @param User $data
     */
    public function persist($data)
    {
        /** @var $logger LoggerInterface */
        $logger = $this->getContainer()->get('logger');
        $this->addFlash('success', 'Article Created! Knowledge is power!');
        $encodedPass = $this->userPasswordEncoder->encodePassword($data, $data->getPlainPassword());
        
        $logger->warning('Yelled: '.$encodedPass);

        $data->setPassword($encodedPass);
        $data->eraseCredentials();
        
        // $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
        //         (new TemplatedEmail())
        //             ->from(new Address('itKamlts.amira@gmail.com', 'Kamlts IT'))
        //             ->to($user->getEmail())
        //             ->subject('Please Confirm your Email')
        //             ->htmlTemplate('registration/confirmation_email.html.twig')
        //     );

        $this->entityManager = $this->getDoctrine()->getManager();
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
    public function remove($data)
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}