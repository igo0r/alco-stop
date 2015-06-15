<?php
namespace AlcoStop\Bundle\UserBundle\Voter;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use AlcoStop\Bundle\UserBundle\Entity\User as User;
use Symfony\Component\Security\Core\User\UserInterface;

class DrinkActivityVoter implements VoterInterface
{
    public function supportsAttribute($attribute)
    {
        return in_array(
            $attribute,
            [
                'EDIT'
            ]
        );
    }

    public function supportsClass($class)
    {
        return 'AlcoStop\Bundle\PartyTimeBundle\Entity\DrinkActivity' === $class;
        //return in_array('FOS\UserBundle\Model\UserInterface', class_implements($class));
    }

    public function vote(TokenInterface $token, $object, array $attributes)
    {
        if (!($this->supportsClass(get_class($object)))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        foreach ($attributes as $attribute) {
            if (!$this->supportsAttribute($attribute)) {
                return VoterInterface::ACCESS_ABSTAIN;
            }
        }

        /** @var User $user */
        $user = $token->getUser();
        if (!($user instanceof UserInterface)) {
            return VoterInterface::ACCESS_DENIED;
        }

        // check if the user has the same company
        if ($user->getId() == $object->getUserId()->getId()) {
            return VoterInterface::ACCESS_GRANTED;
        }

        return VoterInterface::ACCESS_DENIED;
    }

}
