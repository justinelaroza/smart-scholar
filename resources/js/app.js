import './bootstrap';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import Swal from 'sweetalert2'
window.Swal = Swal;

flatpickr(".datepicker", {
  dateFormat: "Y-m-d",
  maxDate: "today",
  allowInput: true,
  onReady: function(selectedDates, dateStr, instance) {
    instance.input.setAttribute('placeholder', 'Birthday');
  },
  onOpen: function(selectedDates, dateStr, instance) {
    instance.input.setAttribute('placeholder', 'Birthday');
  }
});

const today = new Date().toISOString().split("T")[0];
document.querySelectorAll('input[type="date"]').forEach(input => {
  input.setAttribute("max", today);
});