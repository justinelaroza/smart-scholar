import './bootstrap';
import './components/navbar';
import './pages/home';
import './utils/general';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";


flatpickr(".datepicker", {
  altInput: true,
  dateFormat: "Y-m-d",
});