<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\MovieBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class MovieManagerSpec.
 *
 * @package spec\Myclapboard\MovieBundle\Manager
 */
class MovieManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\MovieBundle\Entity\Movie')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\MovieBundle\Entity\Movie')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\MovieBundle\Entity\Movie')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\MovieBundle\Entity\Movie');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\MovieBundle\Entity\Movie');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Manager\MovieManager');
    }

    function it_creates_movies()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\MovieBundle\Entity\Movie');
    }

    function it_finds_one_by_title(EntityRepository $repository, MovieInterface $movie)
    {
        $repository->findOneBy(array('title' => 'movie-title'))
            ->shouldBeCalled()->willReturn($movie);

        $this->findOneByTitle('movie-title')->shouldReturn($movie);
    }

    function it_finds_all_with_defaults_values(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        MovieInterface $movie
    )
    {
        $repository->createQueryBuilder('m')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('m', 'c', 'a', 'i', 're'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.country', 'c')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.awards', 'a')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.images', 'i')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.reviews', 're')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->where(' 1=1 ')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameters(array())->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setMaxResults(10)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setFirstResult(10 * 0)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->orderBy('m.title')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->shouldBeCalled()->willReturn($query);
        $query->getResult()->shouldBeCalled()->willReturn($movie);

        $this->findAll('title');
    }

    function it_filters_movie_with_query_parameter(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        MovieInterface $movie
    )
    {
        $repository->createQueryBuilder('m')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('m', 'c', 'a', 'i', 're'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.country', 'c')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.awards', 'a')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.images', 'i')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.reviews', 're')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->where(' 1=1 AND m.title LIKE :title ')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameters(array('title' => '%dj%'))->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setMaxResults(10)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setFirstResult(10 * 0)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->orderBy('m.country')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->shouldBeCalled()->willReturn($query);
        $query->getResult()->shouldBeCalled()->willReturn($movie);

        $this->findAll('country', 'dj');
    }

    function it_finds_one_by_id(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        MovieInterface $movie,
        Expr $expr,
        Expr\Comparison $comparison
    )
    {
        $repository->createQueryBuilder('m')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('m', 'c', 'ca', 'd', 'w', 'g', 'a', 'i', 're'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.country', 'c')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.cast', 'ca')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.directors', 'd')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.writers', 'w')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.genres', 'g')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.awards', 'a')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.images', 'i')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.reviews', 're')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->expr()->shouldBeCalled()->willReturn($expr);
        $expr->eq('m.id', ':id')->shouldBeCalled()->willReturn($comparison);
        $queryBuilder->where($comparison)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameter(':id', 'movie-id')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->shouldBeCalled()->willReturn($query);
        $query->getOneOrNullResult()->shouldBeCalled()->willReturn($movie);

        $this->findOneById('movie-id')->shouldReturn($movie);
    }
}
