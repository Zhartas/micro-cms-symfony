<?php

namespace AppBundle\Repository;

/**
 * ImagesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImageRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllByPosition() {
       $imagesSelect = [];
        foreach ($this->findAll() as $image) {
            if($image->isPositioned())
            $imagesSelect[$image->getPosition()] = $image;
        }
      return $imagesSelect;
    }
}
