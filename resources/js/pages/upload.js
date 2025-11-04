import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

// Import styles
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

// Register plugins
FilePond.registerPlugin(
  FilePondPluginImagePreview,
  FilePondPluginFileValidateType,
  FilePondPluginFileValidateSize
);

// Initialize
document.addEventListener("DOMContentLoaded", function() {
  const fileInputs = document.querySelectorAll('input[type="file"]');
  fileInputs.forEach(input => {
    FilePond.create(input, {
      allowMultiple: false,
      maxFileSize: '2MB',
      acceptedFileTypes: ['image/jpeg', 'image/png', 'application/pdf'],
      credits: false,
      storeAsFile: true,
      imagePreviewMaxHeight: 300,
      labelIdle: `📂 Drag & Drop your file or <span class="filepond--label-action">Browse</span>`,
    });
  });
});
