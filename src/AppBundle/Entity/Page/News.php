<?php

namespace AppBundle\Entity\Page;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NewsRepository")
 */
class News extends BasePage
{
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Slider", mappedBy="news")
     */
    private $slider;
    /**
     * @ORM\Column(name="foothall", type="boolean", nullable=true)
     */
    private $foothall ;
    /**
     * @ORM\Column(name="not_view", type="boolean", nullable=true)
     */
    private $notView ;

 

    
    /**
     * Set slider.
     *
     * @param \AppBundle\Entity\Slider|null $slider
     *
     * @return News
     */
    public function setSlider(\AppBundle\Entity\Slider $slider = null)
    {
        $this->slider = $slider;

        return $this;
    }


    /**
     * @param bool $foothall
     */
    public function setFoothall($foothall)
    {
        $this->foothall = $foothall;
        return $this;
    }

    /**
     * Get foothall.
     *
     * @return bool
     */
    public function getFoothall()
    {
        return $this->foothall;
    }
    /**
     * @param bool $notView
     */
    public function setNotView($notView)
    {
        $this->notView = $notView;
        return $this;
    }

    /**
     * Get notView.
     *
     * @return bool
     */
    public function getNotView()
    {
        return $this->notView;
    }

    /**
     * Get slider.
     *
     * @return \AppBundle\Entity\Slider|null
     */
    public function getSlider()
    {
        return $this->slider;
    }

    /**
     * Add slider.
     *
     * @param \AppBundle\Entity\Slider $slider
     *
     * @return News
     */
    public function addSlider(\AppBundle\Entity\Slider $slider)
    {
        $this->slider[] = $slider;

        return $this;
    }

    /**
     * Remove slider.
     *
     * @param \AppBundle\Entity\Slider $slider
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSlider(\AppBundle\Entity\Slider $slider)
    {
        return $this->slider->removeElement($slider);
    }
    
}
