<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Doctor CRUD UI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Laravel API CRUD Test</h2>

        <!-- Create/Update Form -->
        <form id="dataForm">
            <input type="hidden" id="id">
            <div class="mb-2">
                <input type="text" id="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="mb-2">
                <input type="text" id="phone" class="form-control" placeholder="Phone" required>
            </div>
            <div class="mb-2">
                <input type="number" id="designation_id" class="form-control" placeholder="Designation ID" required>
            </div>
            <div class="mb-2">
                <input type="number" id="department_id" class="form-control" placeholder="Department ID" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>

        <hr>

        <!-- Data List -->
        <button onclick="loadData()" class="btn btn-primary mb-3">Refresh List</button>
        <ul id="dataList" class="list-group"></ul>
    </div>

    <script>
        const apiUrl = 'http://127.0.0.1:8000/api/doctors';

        // Load all items
        function loadData() {
            fetch(apiUrl)
                .then(res => res.json())
                .then(data => {
                    const list = document.getElementById('dataList');
                    list.innerHTML = '';
                    data.data.forEach(item => {
                        const li = document.createElement('li');
                        li.className = 'list-group-item d-flex justify-content-between align-items-center';
                        li.innerHTML = `
                            <div>
                                <strong>${item.name}</strong> - ${item.phone}
                                <br><small>Designation: ${item.designation_id}, Department: ${item.department_id}</small>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-warning me-1" onclick='editItem(${JSON.stringify(item)})'>Edit</button>
                                <button class="btn btn-sm btn-danger" onclick='deleteItem(${item.id})'>Delete</button>
                            </div>
                        `;
                        list.appendChild(li);
                    });
                });
        }

        // Submit form (Create or Update)
        document.getElementById('dataForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const id = document.getElementById('id').value;
            const payload = {
                name: document.getElementById('name').value,
                phone: document.getElementById('phone').value,
                designation_id: document.getElementById('designation_id').value,
                department_id: document.getElementById('department_id').value,
            };

            const method = id ? 'PUT' : 'POST';
            const url = id ? `${apiUrl}/${id}` : apiUrl;

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            })
                .then(res => res.json())
                .then(() => {
                    this.reset();
                    loadData();
                });
        });

        // Edit item
        function editItem(item) {
            document.getElementById('id').value = item.id;
            document.getElementById('name').value = item.name;
            document.getElementById('phone').value = item.phone;
            document.getElementById('designation_id').value = item.designation_id;
            document.getElementById('department_id').value = item.department_id;
        }

        // Delete item
        function deleteItem(id) {
            if (!confirm('Are you sure?')) return;
            fetch(`${apiUrl}/${id}`, {
                method: 'DELETE'
            })
                .then(() => loadData());
        }

        loadData(); // Initial load
    </script>
</body>

</html>