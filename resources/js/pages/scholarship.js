document.addEventListener('DOMContentLoaded', function () {
  const tbody = document.getElementById('family-table-body');
  const addBtn = document.getElementById('add-family-row');
  const form = document.querySelector('form');

  // find highest index from current rows
  const getNextIndex = () => {
    const inputs = tbody.querySelectorAll('input[name], select[name]');
    let max = -1;
    inputs.forEach(el => {
      const m = el.name.match(/\[(\d+)\]/);
      if (m) max = Math.max(max, parseInt(m[1], 10));
    });
    return max + 1;
  };

  addBtn.addEventListener('click', function (e) {
    e.preventDefault();
    const index = getNextIndex();
    const firstRow = tbody.querySelector('tr');
    const newRow = firstRow.cloneNode(true);

    // Update names and reset values
    newRow.querySelectorAll('input, select').forEach(el => {
      // replace first numeric index with new index
      el.name = el.name.replace(/\[\d+\]/, `[${index}]`);
      if (el.tagName === 'SELECT') el.selectedIndex = 0;
      else el.value = '';
    });

    tbody.appendChild(newRow);
  });

  // remove-row handler
  tbody.addEventListener('click', function (e) {
    const btn = e.target.closest('.remove-row');
    if (!btn) return;
    const rows = tbody.querySelectorAll('tr');
    if (rows.length <= 1) return; // keep at least one row
    btn.closest('tr').remove();
  });

  form.addEventListener('submit', function (e) {
    e.preventDefault(); // prevent default submission
    Swal.fire({
      title: 'Are you sure?',
      text: "Please confirm that all information is correct.",
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, submit!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit(); // submit form after confirmation
      }
    });
  });
});
