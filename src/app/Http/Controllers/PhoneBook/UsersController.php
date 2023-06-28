<?php

namespace App\Http\Controllers\PhoneBook;

use App\Events\User\Created;
use App\Events\User\Deleted;
use App\Events\User\Updated;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\Factories\UserFactory;
use App\Repositories\UsersRepository;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(
        private readonly UsersRepository $usersRepository,
        private readonly UserFactory     $userFactory,
        private UsersService $usersService,
    )
    {
        //
    }

    public function index(Request $request): JsonResponse
    {
        $users = $this->usersRepository->get();

        $filters = $this->usersService->getFilters($users);

        return response()->json([
            'users' => $users,
            'filters' => $filters,
        ]);
    }

    public function save(UserRequest $request): JsonResponse
    {
        $userEntity = $this->userFactory->buildFromArray($request->all());

        $user = $this->usersRepository->createOrUpdate($userEntity);

        Created::dispatch($user);

        return response()->json(['success' => true]);
    }

    public function update(UserRequest $request): JsonResponse
    {
        $userEntity = $this->userFactory->buildFromArray($request->all());

        $user = $this->usersRepository->createOrUpdate($userEntity);

        Updated::dispatch($user);

        return response()->json(['success' => true]);
    }

    public function delete(Request $request): JsonResponse
    {
        $userEntity = $this->usersRepository->getByUuid($request->uuid);

        $this->usersRepository->delete($userEntity->uuid);

        Deleted::dispatch($userEntity);

        return response()->json(['success' => true]);
    }
}
