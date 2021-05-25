<?php

namespace App\Controller;


use App\Entity\Expense;
use App\Form\ExpenseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations\Tag;
use Swagger\Annotations\Schema;
use Swagger\Annotations\Property;
use Swagger\Annotations\Parameter;
use Swagger\Annotations\Response;

/**
 * Class ExpensesController
 * @package App\Controller
 * @Tag(name="Expenses")
 */
class ExpensesController extends AbstractFOSRestController
{

    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){

        $this->entityManager = $entityManager;
    }

    /**
     * List all the expenses.
     * @Route("/api/expenses", name="get_expenses", methods="GET")
     * @Response(
     *     response=200,
     *     description="Returns all the expenses",
     * )
     * @Tag(name="Expenses")
     * @Security(name="Bearer")
     */
    public function getExpensesAction(): array
    {

        $expenses = $this->entityManager->getRepository(Expense::class)->findAll();

        if (!$expenses) {

            throw new HttpException(400, "Invalid data");
        }

        return $expenses;
    }

    /**
     * Get the expenses.
     * @Route("/api/expenses/{id}", name="get_expense", methods="GET")
     * @param int $id
     * @Response(
     *     response=200,
     *     description="Returns an expense",
     * )
     * @Tag(name="Expenses")
     * @Security(name="Bearer")
     * @return object
     */
    public function getExpenseAction(int $id): object
    {
        
        $expense = $this->entityManager->getRepository(Expense::class)->find($id);

        if (!$id) {
            throw new JsonException("Invalid id" ,404);
        }

        if (!$expense) {
            throw new JsonException("Invalid id" ,404);
        }

        return $expense;
	}

    /**
     * Creates an expenses.
     * @Route("/api/expenses", name="post_expense", methods="POST")
     * @Response(
     *     response=200,
     *     description="Save an expense",
     * )
     * @Parameter(
     *   in="body",
     *   name = "body",
     *   @Schema(
     *     type="object",
     *     @Property(property="description", type="string"),
     *     @Property(property="value", type="integer"),
     *   )
     * )
     * @Security(name="Bearer")
     * @param Request $request
     * @return Expense|null
     */
    public function postExpensesAction(Request $request): ?Expense
    {
        $expense = new Expense();
        $form = $this->createForm(ExpenseType::class, $expense);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->entityManager->persist($expense);
            $this->entityManager->flush();
            return $expense;
        }

        throw new JsonException("Invalid id" ,403);
    }

    /**
     * Updates a expense
     * @Route("/api/expenses/{id}", name="put_expense", methods="PUT")
     * @Response(
     *     response=200,
     *     description="Save an expense",
     * )
     * @param int $id
     * @Parameter(
     *   in="body",
     *   name = "body",
     *   @Schema(
     *     type="object",
     *     @Property(property="description", type="string"),
     *     @Property(property="value", type="integer"),
     *   )
     * )
     * @Security(name="Bearer")
     * @return Expense|null
     */
    public function putExpensesAction(Request $request, int $id): object
    {
        $expense = $this->entityManager->getRepository(Expense::class)->find($id);
        $form = $this->createForm(ExpenseType::class, $expense, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->entityManager->persist($expense);
            $this->entityManager->flush();
            return $expense;
        }

        throw new JsonException("Invalid id" ,404);
    }

    /**
     * Delete a expense
     * @Route("/api/expenses/{id}", name="delete_expense", methods="DELETE")
     * @Security(name="Bearer")
     * @Response(
     *     response=200,
     *     description="Save an expense",
     * )

     */
    public function deleteExpensesAction(int $id): object
    {
        $expense = $this->entityManager->getRepository(Expense::class)->find($id);

        if (!$id) {
            throw new JsonException("Invalid id" ,404);
        }

        if($expense === null){
            throw new JsonException("Entity not found" ,404);
        }

        $this->entityManager->remove($expense);
        $this->entityManager->flush();

        return $expense;
    }
}

