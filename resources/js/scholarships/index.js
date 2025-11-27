document.addEventListener('DOMContentLoaded', function() {
    
    // Create notification element if it doesn't exist
    let notification = document.getElementById('realtime-notification');
    if (!notification) {
        notification = document.createElement('div');
        notification.id = 'realtime-notification';
        notification.className = 'hidden fixed top-4 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center gap-4';
        notification.innerHTML = `
            <span id="notification-message">Update available!</span>
            <button onclick="window.location.reload()" class="bg-white text-blue-500 px-4 py-1 rounded font-medium hover:bg-blue-50">
                Refresh
            </button>
            <button onclick="document.getElementById('realtime-notification').classList.add('hidden')" class="text-white hover:text-gray-200">
                ✕
            </button>
        `;
        document.body.appendChild(notification);
    }
    
    const notificationMessage = document.getElementById('notification-message');
    
    window.Echo.channel('scholarships')
        .listen('.scholarship.created', (data) => {
            console.log('✓ New scholarship created:', data);
            addScholarshipToList(data);
            showNotification('🎉 New scholarship: ' + data.title);
        })
        .listen('.scholarship.updated', (data) => {
            console.log('✓ Scholarship updated:', data);
            updateScholarshipInList(data);
            showNotification('✏️ Scholarship updated: ' + data.title);
        })
        .listen('.scholarship.deleted', (data) => {
            console.log('✓ Scholarship deleted:', data);
            removeScholarshipFromList(data.id);
            showNotification('🗑️ A scholarship has been removed');
        });
    
    function addScholarshipToList(data) {
        // Find the container where scholarships are listed
        const scholarshipContainer = document.querySelector('.w-full.flex.flex-col.gap-4.mt-5');
        if (!scholarshipContainer) return;
        
        // Format the deadline
        const deadline = new Date(data.submission_deadline);
        const formattedDeadline = `${String(deadline.getMonth() + 1).padStart(2, '0')}/${String(deadline.getDate()).padStart(2, '0')}/${deadline.getFullYear()}`;
        
        // Create new scholarship card HTML matching your exact structure
        const newScholarship = document.createElement('div');
        newScholarship.setAttribute('data-scholarship-id', data.id);
        newScholarship.className = 'scholarship-item flex flex-col md:flex-row justify-between items-center border p-4 md:p-6 gap-5 md:gap-10 bg-white rounded-lg shadow-sm';
        newScholarship.innerHTML = `
            <div class="flex flex-col items-center md:items-start gap-4 w-full">
                <div class="flex flex-row gap-4 w-full items-start">
                    <div class="w-[100px] min-w-[100px] h-[100px] bg-gray-100 flex md:min-w-[170px] md:w-[170px] md:h-[170px] border rounded-md md:rounded-lg overflow-hidden">
                        <img src="data:image/jpeg;base64,${data.image_base64}" alt="Scholarship image" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-6 md:gap-8 lg:gap-10">
                        <div>
                            <p class="font-semibold responsive-text-medium line-clamp-2">${data.title}</p>
                            <p class="text-gray-500 responsive-text-small line-clamp-1">Funded by <span class="font-medium">@ ${data.funder}</span></p>
                        </div>
                        <div>
                            <p class="text-gray-600 responsive-text-small line-clamp-2">${data.description}</p>
                        </div>
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="grid grid-cols-2 md:grid-cols-4 w-full gap-y-2 gap-x-6 mt-4 text-gray-600 responsive-text-small">
                        <p class="text-center md:text-start">Education Level<br><span class="font-medium text-black">${data.education_level}</span></p>
                        <p class="text-center md:text-start">Submission Deadline<br><span class="font-medium text-black">${formattedDeadline}</span></p>
                        <p class="text-center md:text-start">Scholarship Status<br>
                            <span class="font-medium text-white rounded-2xl px-5 py-1 ${data.status === 'Open' ? 'bg-green-500' : 'bg-red-500'}">
                                ${data.status}
                            </span>
                        </p>
                        <p class="text-center md:text-start">Application Status<br>
                            ${window.isAuthenticated ? 
                                `<span class="font-medium text-white rounded-2xl px-5 py-1 bg-red-500">Not Applied</span>` : 
                                `<a href="/login" class="inline-block font-medium text-white rounded-2xl px-5 py-1 bg-gray-500 hover:bg-gray-600 transition responsive-text-xs text-nowrap">Login First</a>`
                            }
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-4 w-1/2 md:mt-0 md:w-1/4 flex items-center justify-center md:justify-end">
                <a href="/scholarship/${data.id}" 
                    class="bg-[#3B0097] responsive-text-small text-nowrap text-white py-3 w-full rounded-lg hover:bg-[#482DCE] text-center">
                    Learn More
                </a>
            </div>
        `;
        
        // Add to top of list with animation
        newScholarship.style.opacity = '0';
        newScholarship.style.transform = 'translateY(-20px)';
        scholarshipContainer.insertBefore(newScholarship, scholarshipContainer.firstChild);
        
        // Animate in
        setTimeout(() => {
            newScholarship.style.transition = 'opacity 0.5s, transform 0.5s';
            newScholarship.style.opacity = '1';
            newScholarship.style.transform = 'translateY(0)';
        }, 10);
        
        // Highlight effect
        setTimeout(() => {
            newScholarship.classList.add('ring-2', 'ring-green-500');
            setTimeout(() => {
                newScholarship.classList.remove('ring-2', 'ring-green-500');
            }, 2000);
        }, 500);
    }
    
    function showNotification(message) {
        notificationMessage.textContent = message;
        notification.classList.remove('hidden');
        
        // Auto-hide after 10 seconds
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 10000);
    }
    
    function updateScholarshipInList(data) {
        const scholarshipElement = document.querySelector(`[data-scholarship-id="${data.id}"]`);
        if (scholarshipElement) {
            // Find and update status badge
            const statusElements = scholarshipElement.querySelectorAll('span');
            statusElements.forEach(span => {
                if (span.textContent.trim() === 'Open' || span.textContent.trim() === 'Close') {
                    span.textContent = data.status;
                    span.className = `font-medium text-white rounded-2xl px-5 py-1 ${data.status === 'Open' ? 'bg-green-500' : 'bg-red-500'}`;
                }
            });
            // Visual feedback
            scholarshipElement.classList.add('ring-2', 'ring-blue-500', 'transition-all');
            setTimeout(() => {
                scholarshipElement.classList.remove('ring-2', 'ring-blue-500');
            }, 2000);
        }
    }
    
    function removeScholarshipFromList(id) {
        const scholarshipElement = document.querySelector(`[data-scholarship-id="${id}"]`);
        if (scholarshipElement) {
            scholarshipElement.style.transition = 'opacity 0.5s, transform 0.5s';
            scholarshipElement.style.opacity = '0';
            scholarshipElement.style.transform = 'scale(0.95)';
            setTimeout(() => {
                scholarshipElement.remove();
            }, 500);
        }
    }
});