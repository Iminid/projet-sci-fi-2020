<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Pass
{

    private $oldPassword;
    
    /**
     *@Assert\Length(min=8, minMessage="Le mot de passe doit faire au moins 8 caractères !")
     */
    private $newPassword;

    /**
     *@Assert\EqualTo(propertyPath="newPassword", message="Confirmez votre mot de passe !")
     */
    private $confirmPass;


    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword(string $oldPassword): self
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmPass(): ?string
    {
        return $this->confirmPass;
    }

    public function setConfirmPass(string $confirmPass): self
    {
        $this->confirmPass = $confirmPass;

        return $this;
    }
}
