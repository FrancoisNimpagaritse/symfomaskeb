<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Donor;
use App\Entity\Income;
use App\Entity\Expense;
use App\Entity\CategoryIncome;
use App\Entity\CategoryExpense;
use App\Entity\Child;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');

        //Nous gérons les utilisateurs
        $users = [];
        for($i = 1; $i <= 5; $i++)
        {
            $user = new User();
            $pass = $this->encoder->encodePassword($user, "12345");
             $user->setFirstname($faker->firstName)
                    ->setLastname($faker->lastName)
                    ->setEmail($faker->email)
                    ->setHash($pass);
    
             $manager->persist($user);
             $users[] = $user;
        }

        //Nous gérons les donateurs
        $donors = [];
        for($i=1; $i<=20; $i++)
        {
            $donor = new Donor();
            $donor->setName($faker->name)
                  ->setAdresse($faker->address)
                  ->setType($faker->text(15))
                  ->setPhone($faker->phoneNumber)
                  ->setEmail($faker->email)
                  ->setDateJoined($faker->dateTimeBetween('-1 years','now'));
            $manager->persist($donor);
            $donors[] = $donor;
        }

         //Nous gérons les categories de ressources
         $catIns = [];
        for($i=1; $i<=5; $i++)
        {
            $catIncome = new CategoryIncome();
            $catIncome->setName($faker->name)
                      ->setDescription($faker->sentence());

            $manager->persist($catIncome);
            $catIns[] = $catIncome;
        }
         //Nous gérons les ressources
        for($i=1; $i<=15; $i++)
        {
            $inco = new Income();
            $user = $users[mt_rand(0, 4)];
            $catInc = $catIns[mt_rand(0,4)];
            $donr = $donors[mt_rand(0,19)];

            $inco->setDateIncome($faker->dateTimeBetween('-1 years','now'))
                ->setDescription($faker->sentence())
                ->setCategoryIncome($catInc)
                ->setAmount(mt_rand(10,500))
                ->setDonor($donr)
                ->setEditor($user);

            $manager->persist($inco);
        }
         //Nous gérons les catégories dépenses
        $catExps = [];
        for($i=1; $i<=10; $i++)
        {
            $catExpense = new CategoryExpense();
            
            $catExpense->setName($faker->name);
            $catExpense->setDescription($faker->sentence());
            
            $manager->persist($catExpense);
            $catExps[] = $catExpense;
        }
        //nous gérons les dépenses
        for($i=1; $i<=30; $i++)
        {
            $exp = new Expense();
            $user = $users[mt_rand(0,4)];
            $catExp = $catExps[mt_rand(0,9)];

            $exp->setDateExpense($faker->dateTimeBetween('-1 years','now'))
                ->setDescription($faker->text(15))
                ->setCategoryExpense($catExp)
                ->setAmount(mt_rand(1,50))
                ->setEditor($user);

            $manager->persist($exp);

        }

         //Nous gérons les enfants
         for($i=1; $i<=50; $i++)
         {
            $kid = new Child();
            $kid->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setDateBith($faker->dateTimeBetween('-12 years','now'))
                ->setPlaceOfBirth($faker->address)
                ->setCommuneOfBirth($faker->text(20))
                ->setProvinceOfBirth($faker->text(15))
                ->setFirstnameFather($faker->firstNameMale)
                ->setLastnameFather($faker->lastName)
                ->setFirstnameMother($faker->firstNameFemale)
                ->setLastnameMother($faker->lastName)
                ->setAdresseCommune($faker->text(15))
                ->setAdresseZone($faker->text(15))
                ->setAdresseProvince($faker->text(20))
                ->setPhoto($faker->imageUrl(640,480))
                ->setDescription($faker->sentence())
                ->setDateJoined($faker->dateTimeBetween('-1 years', 'now'));

            $manager->persist($kid);
        }

        $manager->flush();
    }
}
