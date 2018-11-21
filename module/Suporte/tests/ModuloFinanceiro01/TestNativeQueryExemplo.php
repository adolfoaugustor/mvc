<?php

namespace Rtd\Suporte\Tests\ModuloFinanceiro01;

use Doctrine\ORM\Query\Expr;
use Rtd\Suporte\Entity\Central\Pessoa;
use Sistema\PhpUnit\TesteSistema;

class TestNativeQueryExemplo extends TesteSistema
{

    /**
     * Uso em queries muito complexas e tabelas que não são auto inclrement, que buga as Entidades
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testObterUltimasPessoasComRawQuery(){

        $query  = "SELECT p.ni,pf.estado_civil FROM central.pessoa p
              INNER JOIN central.pessoa_fisica pf  ON p.ni = pf.ni
              where p.ni =:id
            ";
        $em = $this->getDoctrine()->getConnection();
        $stmt = $em->prepare($query);
        $stmt->bindValue(':id','01836593333');
        $stmt->execute();
        var_dump($stmt->fetchAll());

    }

    public function testAliasQueryBuilder(){

        $qb  = $this->getDoctrine()->createQueryBuilder();

        $query = $qb->select('p')
            ->from(Pessoa::class,'p')
            ->getQuery()->getSQL();

       var_dump($query);

    }
}