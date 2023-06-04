import './bootstrap';
import 'alpinejs';
import { Chart } from 'frappe-charts/dist/frappe-charts.min.esm';

window.frappe = { Chart }; // Make Frappe.js available globally
window.Alpine = Alpine
 
Alpine.start()