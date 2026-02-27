@extends('layouts.admin')

@section('content')

<h2>Create Product</h2>
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div>
        <label>Name</label>
        <input type="text" name="name">
    </div>
    <div id="acFields" style="display:none;">
    <label>Horsepower</label>
    <input type="number" step="0.1" name="horsepower">

    <label>Energy Rating</label>
    <input type="text" name="energy_rating">
</div>
<div id="filterFields" style="display:none;">
    <label>Number of Stages</label>
    <input type="number" name="number_of_stages">
</div>

    <div>
        <label>Price</label>
        <input type="text" name="price">
    </div>
    <input type="hidden" name="type" id="productType">
    <div>
        <label>inStock</label>
        <input type="text" name="inStock">
    </div>
    <div>
        <label>Description</label>
        <input type="text" name="description">
    </div>
    <div>
        <label>Brand</label>
        <input type="text" name="brand">
    </div>

    <div>
        <label>Category</label>
        <select name="category_id" id="categorySelect">
            <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option 
    value="{{ $category->id }}"
    data-type="{{ $category->type }}"
>
    {{ $category->name }}
</option>
                @endforeach
        </select>
        <button type="button" onclick="openModal()">+ Add</button>
    </div>

    <button type="submit">Save</button>

</form>
<div id="categoryModal" style="display:none; background:#00000080; position:fixed; top:0; left:0; width:100%; height:100%;">

    <div style="background:white; padding:20px; width:300px; margin:100px auto;">
        <h4>Create Category</h4>
        <label>Category Name</label>
        <input type="text" id="newCategoryName">
<br><br>

        <select id="newCategoryType">
    <option value="ac">AC</option>
    <option value="water_filter">Water Filter</option>
</select>

        <br><br>

        <button onclick="storeCategory()">Save</button>
        <button onclick="closeModal()">Cancel</button>
    </div>
    <p id="categoryMsg" style="color:red; display:none;">must add category first</p></p>

</div>
<script>

const categorySelect = document.getElementById('categorySelect');
const acFields = document.getElementById('acFields');
const filterFields = document.getElementById('filterFields');
const productType = document.getElementById('productType');

categorySelect.addEventListener('change', function () {

    let selected = this.options[this.selectedIndex];
    let type = selected.getAttribute('data-type');

    productType.value = type;

    acFields.style.display = 'none';
    filterFields.style.display = 'none';

    if (type === 'ac') {
        acFields.style.display = 'block';
    }

    if (type === 'water_filter') {
        filterFields.style.display = 'block';
    }

});
    

    
</script>
<script>
function openModal() {
    document.getElementById('categoryModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('categoryModal').style.display = 'none';
}

function storeCategory() {

    let nameInput = document.getElementById('newCategoryName'); 
    let typeSelect = document.getElementById('newCategoryType'); 
    const acFields = document.getElementById('acFields');
    const filterFields = document.getElementById('filterFields');
    const saveBtn = event.target;

   
    let name = nameInput.value; 
    let type = typeSelect.value; 
    saveBtn.disabled = true;
    saveBtn.innerText = "جاري الحفظ...";

    fetch("{{ route('categories.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            name: name,
            type: type
        })
    })
    .then(response =>{
        if (!response.ok) {
            //if the server sent error like  trying insert duplicated data in database
            return response.json().then(err => {
               let isDuplicate = err.message?.includes('Duplicate entry') || err.errors?.name;

                let errorMsg = isDuplicate 
                ? "The category is already exist" 
                : (err.message ||"unexpected error occured");

                alert("Error: " + errorMsg);
         
                throw new Error('Duplicate entry'); 
            });
        }
        return response.json();
    })
    .then(data => {
        if(data.id && data.name){

        let select = document.getElementById('categorySelect');

        let option = document.createElement("option");
        option.value = data.id;
        option.text = data.name;
        option.setAttribute('data-type', data.type);
        option.selected = true;

        select.appendChild(option);
        document.getElementById('productType').value = type;
        const acFields = document.getElementById('acFields');
    const filterFields = document.getElementById('filterFields');

    acFields.style.display = 'none';
    filterFields.style.display = 'none';

    if (data.type === 'ac') {
        acFields.style.display = 'block';
    }

    if (data.type === 'water_filter') {
        filterFields.style.display = 'block';
    }

        closeModal();
        console.log("the product is added " + data.type);
    }else{
        console.error("the value is already taken", data);
        closeModal();
    }

    });
   
        saveBtn.disabled = false;
        saveBtn.innerText = "Save";
    
}
</script>


@endsection