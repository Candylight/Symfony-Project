<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Event", mappedBy="participant")
     */
    private $participant;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="RFriends")
     * @ORM\JoinTable(name="Friends",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $friends;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="friends")
     */
    private $RFriends;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Add participant
     *
     * @param \AppBundle\Entity\Event $participant
     *
     * @return User
     */
    public function addParticipant(\AppBundle\Entity\Event $participant)
    {
        $this->participant[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \AppBundle\Entity\Event $participant
     */
    public function removeParticipant(\AppBundle\Entity\Event $participant)
    {
        $this->participant->removeElement($participant);
    }

    /**
     * Get participant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Add friend
     *
     * @param \AppBundle\Entity\User $friend
     *
     * @return User
     */
    public function addFriend(\AppBundle\Entity\User $friend)
    {
        $this->friends[] = $friend;

        return $this;
    }

    /**
     * Remove friend
     *
     * @param \AppBundle\Entity\User $friend
     */
    public function removeFriend(\AppBundle\Entity\User $friend)
    {
        $this->friends->removeElement($friend);
    }

    /**
     * Get friends
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * Add rFriend
     *
     * @param \AppBundle\Entity\Event $rFriend
     *
     * @return User
     */
    public function addRFriend(\AppBundle\Entity\Event $rFriend)
    {
        $this->RFriends[] = $rFriend;

        return $this;
    }

    /**
     * Remove rFriend
     *
     * @param \AppBundle\Entity\Event $rFriend
     */
    public function removeRFriend(\AppBundle\Entity\Event $rFriend)
    {
        $this->RFriends->removeElement($rFriend);
    }

    /**
     * Get rFriends
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRFriends()
    {
        return $this->RFriends;
    }

    public function isFriend($user)
    {
        foreach ($this->getFriends() as $friend) {
            if($friend->getId() == $user->getId())
            {
                return true;
            }
        }
        return false;
    }
}
