<?php

namespace App\DataFixtures;

use App\Entity\Empresas;
use App\Entity\Sectores;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture {

    public function load(ObjectManager $manager) {

        $sector = new Sectores();
        $sector->setNombre('Alimenticio');
        $manager->persist($sector);

        $empresa = new empresas();
        $empresa->setNombre('meal.ly');
        $empresa->setEmail('meal@meal.ly');
        $empresa->setTelefono(643235234);
        $empresa->setSector($sector);
        $manager->persist($empresa);

        $empresa = new empresas();
        $empresa->setNombre('nutriti');
        $empresa->setEmail('nutriti@gmail.com');
        $empresa->setTelefono(653546765);
        $empresa->setSector($sector);
        $manager->persist($empresa);

        $sector = new Sectores();
        $sector->setNombre('Tecnologico');
        $manager->persist($sector);

        $empresa = new empresas();
        $empresa->setNombre('LastComputer');
        $empresa->setEmail('LastComputer@gmail.com');
        $empresa->setTelefono(654345645);
        $empresa->setSector($sector);
        $manager->persist($empresa);

        $empresa = new empresas();
        $empresa->setNombre('cobyte');
        $empresa->setEmail('cobyte@cobyte.com');
        $empresa->setTelefono(6932827392);
        $empresa->setSector($sector);
        $manager->persist($empresa);

        $sector = new Sectores();
        $sector->setNombre('Automocion');
        $manager->persist($sector);

        $empresa = new empresas();
        $empresa->setNombre('automobus');
        $empresa->setEmail('automobus@gmail.com');
        $empresa->setTelefono(9438459283);
        $empresa->setSector($sector);
        $manager->persist($empresa);

        $empresa = new empresas();
        $empresa->setNombre('collabcar');
        $empresa->setEmail('collabcar@gmail.com');
        $empresa->setTelefono(938283823);
        $empresa->setSector($sector);
        $manager->persist($empresa);

        $sector = new Sectores();
        $sector->setNombre('Financiero');
        $manager->persist($sector);

        $empresa = new empresas();
        $empresa->setNombre('funding.ly');
        $empresa->setEmail('funding@funding.ly');
        $empresa->setTelefono(653456723);
        $empresa->setSector($sector);
        $manager->persist($empresa);

        $empresa = new empresas();
        $empresa->setNombre('moneyswipe');
        $empresa->setEmail('moneyswipe@gamil.com');
        $empresa->setTelefono(645343532);
        $empresa->setSector($sector);
        $manager->persist($empresa);

        $manager->flush();
    }

}
