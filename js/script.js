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


document.getElementById('cardNumber').addEventListener('input', function(e) {
    const input = e.target;
    let value = input.value;
    
    let cursor = input.selectionStart;

    value = value.replace(/[^0-9]/g, '');

  
    const formattedValue = value.replace(/(.{4})/g, '$1 ').trim();

    input.value = formattedValue;

    if (cursor < formattedValue.length) {
      
      if (formattedValue[cursor - 1] === ' ' && input.value.length > input.selectionEnd) {
        cursor++;
      }
      input.setSelectionRange(cursor, cursor);
    }
});
