<?php
namespace App\BrowserApi;

use App\Modules\Workspaces\Domains\Errors\WorkspaceError;
use App\Modules\Workspaces\UseCases\CreateWorkspace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkspaceController {

   public function __construct(
    private readonly CreateWorkspace $createWorkspace
   )
   {
   }

   public function create(Request $request): JsonResponse{
    $result = $this->createWorkspace->execute(
        $request->string('name')->toString(),
        $request->string('image_url')->toString()
    );
    
    if($result->isErr()){
        return match($result->unwrapErr()){
            WorkspaceError::InvalidName => response()->json(['error_code' => 'invalid_workspace_name'], 400)
        };
    }

    $unwrappedResult = $result->unwrap();
    return response()->json([
        'id' => $unwrappedResult->id,
        'name' => $unwrappedResult->name,
        'imageUrl' => $unwrappedResult->imageUrl
    ],201);
   }
}