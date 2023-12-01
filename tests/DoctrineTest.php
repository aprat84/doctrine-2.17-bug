<?php

namespace App\Tests;

use App\Entity\Language;
use App\Entity\Product;
use App\Entity\ProductTranslation;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class DoctrineTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();

        /** @var EntityManager $em */
        $em = static::getContainer()->get('doctrine.orm.entity_manager');

        $em->getConnection()->beginTransaction();

        $english = new Language('en');
        $spanish = new Language('es');
        $product = new Product();

        $englishTranslation = new ProductTranslation($product, $english);
        $englishTranslation->setName('Test Product!');
        $product->addTranslation($englishTranslation);

        $spanishTranslation = new ProductTranslation($product, $spanish);
        $spanishTranslation->setName('Producto de prueba!');
        $product->addTranslation($spanishTranslation);

        $em->persist($english);
        $em->persist($spanish);
        $em->persist($product);
        $em->flush();
        $em->clear();

        $product = $em->getRepository(Product::class)->findOneBy([]);

        $em->getConnection()->rollBack();

        $this->assertArrayHasKey('en', $product->getTranslations());
        $this->assertArrayHasKey('es', $product->getTranslations());
    }
}
