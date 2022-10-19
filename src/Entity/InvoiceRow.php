<?php

namespace App\Entity;

use App\Repository\InvoiceRowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRowRepository::class)]
class InvoiceRow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $number = null;

    #[ORM\ManyToOne(inversedBy: 'invoiceRows')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Invoice $invoice = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chamber $chamber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?float
    {
        return $this->number;
    }

    public function setNumber(float $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getChamber(): ?Chamber
    {
        return $this->chamber;
    }

    public function setChamber(?Chamber $chamber): self
    {
        $this->chamber = $chamber;

        return $this;
    }

    public function __toString() {
        return $this->getChamber()->getId().' '.$this->getChamber()->getName().'  €'.($this->getChamber()->getPrice()*$this->getNumber());
    }
}
