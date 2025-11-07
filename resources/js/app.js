import './bootstrap';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import Swal from 'sweetalert2'
window.Swal = Swal;

flatpickr(".datepicker", {
  altInput: true,
  dateFormat: "Y-m-d",
  onReady: function(selectedDates, dateStr, instance) {
    if (instance.altInput) {
      instance.altInput.removeAttribute("readonly");
      instance.altInput.setAttribute("placeholder", "Birthday");
    }
  }
});