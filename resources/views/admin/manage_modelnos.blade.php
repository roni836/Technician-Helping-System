@extends('decision_tree.base')

@section('content')
<div class="p-4">
    <!-- Header with Add Model Button -->
    <div class="flex justify-between p-3">
        <h2 class="text-xl font-bold">Manage Models</h2>
        <button data-modal-target="add-model-modal" data-modal-toggle="add-model-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5" type="button">
            Add New Model
        </button>
    </div>

    <!-- Add Model Modal -->
    <div id="add-model-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)]">
        <div class="relative p-4 w-full max-w-2xl">
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">Insert Model</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8" data-modal-hide="add-model-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="p-4 space-y-4">
                    <form action="{{ route('modelnos.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="model_number" class="block text-sm font-medium text-gray-700">Model Number</label>
                            <input type="text" id="model_number" name="model_number" class="w-full px-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none rounded-lg text-sm px-5 py-2.5">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Model Modal -->
    <div id="edit-model-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)]">
        <div class="relative p-4 w-full max-w-2xl">
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">Edit Model</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8" data-modal-hide="edit-model-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="p-4 space-y-4">
                    <form id="edit-model-form" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_model_number" class="block text-sm font-medium text-gray-700">Model Number</label>
                            <input type="text" id="edit_model_number" name="model_number" class="w-full px-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none rounded-lg text-sm px-5 py-2.5">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Models Table -->
    <div class="flex flex-1 mt-4">
        <table class="border w-full">
            <thead>
                <tr>
                    <th class="border p-3">Id</th>
                    <th class="border p-3">Model Number</th>
                    <th class="border p-3">Created</th>
                    <th class="border p-3">Updated</th>
                    <th class="border p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modelnos as $modelno)
                <tr>
                    <td class="border p-3">{{ $modelno->id }}</td>
                    <td class="border p-3">{{ $modelno->model_number }}</td>
                    <td class="border p-3">{{ $modelno->created_at }}</td>
                    <td class="border p-3">{{ $modelno->updated_at }}</td>
                    <td class="border p-3">
                        <!-- Edit Button (Populates and shows edit modal) -->
                        <button type="button" class="edit-model-button text-blue-600 hover:underline" data-modal-target="edit-model-modal" data-modal-toggle="edit-model-modal" data-id="{{ $modelno->id }}" data-model_number="{{ $modelno->model_number }}">
                            Edit
                        </button>
                        <!-- Delete Form -->
                        <form action="{{ route('modelnos.destroy', $modelno->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript for Populating the Edit Model Modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-model-button');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const modelId = this.getAttribute('data-id');
            const modelNumber = this.getAttribute('data-model_number');
            
            // Update the form action dynamically based on the selected model ID.
            const editForm = document.getElementById('edit-model-form');
            editForm.action = '/modelnos/' + modelId;
            
            // Populate the input with the current model number.
            document.getElementById('edit_model_number').value = modelNumber;
        });
    });
});
</script>
@endsection

