document.addEventListener('DOMContentLoaded', function() {
    const unitSelect = document.getElementById('unit_id');
    const departmentSelect = document.getElementById('department_id');

    if (unitSelect && departmentSelect) {
        unitSelect.addEventListener('change', function() {
            const unitId = this.value;
            const department_id = this;
            console.log(department_id)
            // Clear departments
            departmentSelect.innerHTML = '<option value="">Loading...</option>';

            if (unitId) {
                // Fetch departments for the selected unit
                fetch(`/units/${unitId}/departments`)
                    .then(response => response.json())
                    .then(departments => {
                        departments.forEach(department => {
                            const option = document.createElement('option');
                            option.selected = department.id == department_id;
                            departmentSelect.add(option);
                            option.value = department.id;
                            option.textContent = department.name;
                            departmentSelect.appendChild(option);
                        });
                    });
            }
        });
    }
});
