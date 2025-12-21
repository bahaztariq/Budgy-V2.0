const modals = document.querySelectorAll('.modal');
const closemodal = document.querySelectorAll('.close-Modal-btn');
const addRevenuBtn = document.querySelector('.Add-revenu-btn');
const addRevenuForm = document.querySelector('.Add-revenu-form');
const addExpencesBtn = document.querySelector('.Add-expences-btn');
const addExpencesForm = document.querySelector('.Add-expences-form');
const addCardBtn = document.querySelector('.Add-Card-btn');
const addCardForm = document.querySelector('.Add-card-form');
const modifyRevenuModal = document.querySelector('.Modify-revenu-form');
const modifyexpencesModal = document.querySelector('.Modify-expences-form');

modals.forEach((mdl) => {
    mdl.addEventListener('click', (e) => {
        if (e.target.classList.contains('modal')) {
            mdl.classList.add('hidden');
        }
    })
})

if (addRevenuBtn) {
    addRevenuBtn.addEventListener('click', () => {
        addRevenuForm.classList.remove('hidden');
    })
}

if (addExpencesBtn) {
    addExpencesBtn.addEventListener('click', () => {
        addExpencesForm.classList.remove('hidden');
    })
}
if (addCardBtn) {
    addCardBtn.addEventListener('click', () => {
        addCardForm.classList.remove('hidden');
    })
}

closemodal.forEach((closemdl) => {
    closemdl.addEventListener('click', (e) => {
        const parentModal = closemdl.closest('.modal');
        if (parentModal) {
            parentModal.classList.add('hidden');
        }
    })
})
window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('edit_id')) {
        modifyRevenuModal.classList.remove('hidden');
        modifyexpencesModal.classList.remove('hidden');
    }
});

// Only run chart code if the elements exist
const ctx = document.getElementById('LineChart');
const dtx = document.getElementById('DonutChart');

if (ctx && typeof Donut !== 'undefined') {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Revenu', 'Expences', 'Balance'],
            datasets: [{
                label: '# of Moneeey',
                data: Donut,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

if (dtx && typeof Donut !== 'undefined') {
    console.log(Donut);
    new Chart(dtx, {
        type: 'doughnut',
        data: {
            labels: ['Expences', 'Revenus', 'Balance'],
            datasets: [{
                label: 'My First Dataset',
                data: Donut,
                backgroundColor: [
                    'rgba(249, 64, 104, 1)',
                    'rgba(64, 98, 219, 1)',
                    'rgba(224, 177, 66, 1)'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            rotation: -90,
            // circumference: 180,
        }
    });
}
const cardNumber =document.getElementById('cardNumber')

if(cardNumber){cardNumber.addEventListener('input', function(e) {
    let raw = e.target.value.replace(/\D/g, "").slice(0, 16);
    e.target.value = raw.replace(/(.{4})/g, "$1 ").trim();
});
}
const cardSelect = document.getElementById('cardSelect');
const amountInput = document.getElementById('amountInput');
const balanceMsg = document.getElementById('balanceMsg');

function updateMaxBalance() {
    const selectedOption = cardSelect.options[cardSelect.selectedIndex];
    const balance = selectedOption.getAttribute('data-balance');
    amountInput.max = balance;
    balanceMsg.innerText = `Max transferable: $${balance}`;
}
if(cardSelect.options.length > 0) {
            updateMaxBalance();
}
cardSelect.addEventListener('change', updateMaxBalance);

function toggleStatus(id, checkbox) {
    const isActive = checkbox.checked ? 1 : 0;
    fetch('../Cards/update_status.php', {
        method: 'POST',
        body: new URLSearchParams({ 
            'id': id, 
            'isActive': isActive 
        })
    }).then(res => res.json())
      .then(data => { 
        if(!data.success)
            alert('Update failed')
         });
    

    const textSpan = document.getElementById('status-text-' + id);
    const container = document.getElementById('card-container-' + id);

    if (isActive) {
        textSpan.innerText = 'Active';
        container.classList.remove('opacity-60', 'grayscale');
    } else {
        textSpan.innerText = 'inActive';
        container.classList.add('opacity-60', 'grayscale');
    }
}