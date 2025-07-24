@extends('decision_tree.base')
@section('content')
    @auth
    @if(Auth::user()->is_admin)

   
    <div class="flex space-x-4 p-4 items-center justify-center mt-3">
        <button id="openDeviceModalButton"
            class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
            Add New Device
        </button>
        <button id="openModelModalButton"
            class="bg-teal-800 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
            Add New Model
        </button>
        <button id="openModalButton"
            class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
            Add New Problem
        </button>
        <button id="openBrandModalButton"
            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
            Add New Brand
        </button>
    </div>
    
    @endif
    <div class="w-1/3 mx-auto bg-white p-6 rounded-lg shadow  border border-teal-600 mt-8 ">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Select Brand and Problem</h1>
        <form action="{{ route('decision_tree.show') }}" method="POST">
            @csrf
            <label for="device">Device:</label>
            <select name="device_id" id="device"
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5">
                <option value="">Select a Device</option>
                @foreach ($devices as $device)
                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                @endforeach
            </select>

            <label for="brand">Brand:</label>
            <select name="brand_id" id="brand"
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5">
                <option value="">Select a Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            <label for="modelno">ModelNo:</label>
            <select name="modelno_id" id="modelno"
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5">
                <option value="">Select ModelNo</option>
                @foreach ($modelnos as $modelno)
                    <option value="{{ $modelno->id }}">{{ $modelno->model_number }}</option>
                @endforeach
            </select>

            
           

            <label for="problem">Problem:</label>
            <select name="problem_id" id="problem"
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select a Problem</option>
            </select>

            <button type="submit" disabled id="start-btn"
                class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 mt-5 w-1/3">Start</button>
        </form>
    </div>


    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-8 shadow border rounded-lg w-96 relative">
            <button id="closeModalButton" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
                ✖
            </button>
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Problem</h1>
            <form action="{{ route('problem.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="device_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Device:
                    </label>
                    <select name="device_id"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Select a Device --</option>
                        @if ($devices->isNotEmpty())
                            @foreach ($devices as $data)
                                <option value="{{ $data->id }}" {{ old('device_id') == $data->id ? 'selected' : '' }}>
                                    {{ $data->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="mb-4">
                    <label for="brand_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Brand:
                    </label>
                    <select name="brand_id"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Select a Brand --</option>
                        @if ($brands->isNotEmpty())
                            @foreach ($brands as $data)
                                <option value="{{ $data->id }}" {{ old('brand_id') == $data->id ? 'selected' : '' }}>
                                    {{ $data->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="mb-4">
                    <label for="device_id" class="block text-sm font-medium text-gray-700 mb-2">
                        ModelNo:
                    </label>
                    <select name="modelno_id"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Select a ModelNo--</option>
                        @if ($modelnos->isNotEmpty())
                            @foreach ($modelnos as $data)
                                <option value="{{ $data->id }}" {{ old('modelno_id') == $data->id ? 'selected' : '' }}>
                                    {{ $data->model_number }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
               
                <div class="mb-6">
                    <label for="name" class="block font-medium text-gray-600 mb-2">Enter Problem:</label>
                    <input type="text" name="name" id="name" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <button type="submit"
                        class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                        Save Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="brandModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-8 shadow border rounded-lg w-96 relative">
            <!-- Close Button -->
            <button id="closeBrandModalButton" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
                ✖
            </button>

            <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Brand</h1>
            <form action="{{ route('brand.store') }}" method="POST">
                @csrf
               
                <div class="mb-6">
                    <label for="brand_name" class="block font-medium text-gray-600 mb-2">Enter Brand Name:</label>
                    <input type="text" name="name" id="brand_name" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                </div>
                <div>
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                        Save Brand
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="deviceModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-8 shadow border rounded-lg w-96 relative">
            <!-- Close Button -->
            <button id="closedeviceModalButton" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
                ✖
            </button>

            <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Device</h1>
            <form action="{{ route('device.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="device_name" class="block font-medium text-gray-600 mb-2">Enter Device Name:</label>
                    <input type="text" name="name" id="device_name" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                </div>
                <div>
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                        Save Device
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modelModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-8 shadow border rounded-lg w-96 relative">
          
            <button id="closeModelModalButton" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
                ✖
            </button>
    
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Model No</h1>
            <form action="{{ route('modelno.store') }}" method="POST">
                @csrf
              
                <div class="mb-6">
                    <label for="model_number" class="block font-medium text-gray-600 mb-2">Enter Model Number:</label>
                    <input type="text" name="model_number" id="model_number" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                </div>
                <div>
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                        Save Model
                    </button>
                </div>
            </form>
        </div>
    </div>
    


    <script>
        $('#brand').on('change', function() {
            const brandId = $(this).val();
            if (brandId) {
                $.post("{{ route('decision_tree.get_problems') }}", {
                    _token: '{{ csrf_token() }}',
                    brand_id: brandId
                }, function(data) {
                    $('#problem').html('<option value="">Select a Problem</option>');
                    data.forEach(function(problem) {
                        $('#problem').append(
                            `<option value="${problem.id}">${problem.name}</option>`);
                    });
                    $('#start-btn').prop('disabled', true);
                });
            } else {
                $('#problem').html('<option value="">Select a Problem</option>');
                $('#start-btn').prop('disabled', true);
            }
        });

        $('#problem').on('change', function() {
            $('#start-btn').prop('disabled', !$(this).val());
        });
    </script>
  
    <script>
        // problem
        // Get modal elements
        const modal = document.getElementById('modal');
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');

        // Open modal
        openModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        // Close modal
        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Close modal when clicking outside the modal content
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>

    <script>
        // Get modal elements
        const brandModal = document.getElementById('brandModal');
        const openBrandModalButton = document.getElementById('openBrandModalButton');
        const closeBrandModalButton = document.getElementById('closeBrandModalButton');

        // Open modal
        openBrandModalButton.addEventListener('click', () => {
            brandModal.classList.remove('hidden');
        });

        // Close modal
        closeBrandModalButton.addEventListener('click', () => {
            brandModal.classList.add('hidden');
        });

        // Close modal when clicking outside the modal content
        window.addEventListener('click', (e) => {
            if (e.target === brandModal) {
                brandModal.classList.add('hidden');
            }
        });
    </script>
     
     <script>
        // device
        // Get modal elements
        const deviceModal = document.getElementById('deviceModal');
        const openDeviceModalButton = document.getElementById('openDeviceModalButton');
        const closeDeviceModalButton = document.getElementById('closedeviceModalButton');
    
        // Open modal
        openDeviceModalButton.addEventListener('click', () => {
            deviceModal.classList.remove('hidden');
        });
    
        // Close modal
        closeDeviceModalButton.addEventListener('click', () => {
            deviceModal.classList.add('hidden');
        });
    
        // Close modal when clicking outside the modal content
        window.addEventListener('click', (e) => {
            if (e.target === deviceModal) {
                deviceModal.classList.add('hidden');
            }
        });
    </script>

<script>
    // ModelNo Modal
    const modelModal = document.getElementById('modelModal');
    const openModelModalButton = document.getElementById('openModelModalButton');
    const closeModelModalButton = document.getElementById('closeModelModalButton');

    // Open modal
    openModelModalButton.addEventListener('click', () => {
        modelModal.classList.remove('hidden');
    });

    // Close modal
    closeModelModalButton.addEventListener('click', () => {
        modelModal.classList.add('hidden');
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', (e) => {
        if (e.target === modelModal) {
            modelModal.classList.add('hidden');
        }
    });
</script>

@else
<div class="text-center text-red-500 text-xl font-bold mt-10">
    You must be logged in to access this page.
</div>
@endif
@endsection
