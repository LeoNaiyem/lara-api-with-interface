<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Patient CRUD UI</title>
</head>

<body class="bg-secondary text-light">
    <div class="container">
        <div class="card px-4 mb-3">
            <div class="card-title d-flex justify-content-between align-items-center">
                <h1>Patient List</h1>
                <a href="{{ url('/patients/create') }}" class="btn btn-success">+ Add new Patient</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead class="table-primary ">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Date Of Birth</th>
                    <th>mob_ext</th>
                    <th>Gender</th>
                    <th>Profession</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>
</body>
<script>
    async function apiRequest(endpoint, method = 'GET', data = null) {
        const uri = `http://127.0.0.1:8000/api/${endpoint}`
        const options = {
            method,
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json'
            }
        };
        if (data) {
            options.body = JSON.stringify(data);
        }
        const response = await fetch(uri, options);
        if (!response.ok) {
            const error = await response.json();
            throw error;
        }
        return response.json();
    }
    // get all patients
    apiRequest('patients')
        .then(data => showPatients(data.data))
        .catch(error => console.log(error));


    function showPatients(patients) {
        const tbody = document.getElementById('tbody');
        patients.forEach(patient => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${patient.id}</td>
                <td>${patient.name}</td>
                <td>${patient.mobile}</td>
                <td>${patient.dob}</td>
                <td>${patient.mob_ext}</td>
                <td>${patient.gender}</td>
                <td>${patient.profession ?? 'Not Applicable'}</td>
            `;
            tbody.appendChild(tr);
        });
    }

</script>

</html>