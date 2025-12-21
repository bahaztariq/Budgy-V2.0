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
        if(modifyRevenuModal) modifyRevenuModal.classList.remove('hidden');
        if(modifyexpencesModal) modifyexpencesModal.classList.remove('hidden');
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
const inputHolder = document.getElementById('input-holder');
const inputNumber = document.getElementById('input-number');
const inputExpiry = document.getElementById('input-expiry');
const inputBank   = document.getElementById('input-bank');
const inputType   = document.getElementById('input-type');

const displayHolder = document.getElementById('display-holder');
const displayNumber = document.getElementById('display-number');
const displayExpiry = document.getElementById('display-expiry');
const displayBank   = document.getElementById('display-bank');
const displayType   = document.getElementById('display-type');

const defaults = {
    holder: 'JOHN DOE',
    number: '0000 0000 0000 0000',
    expiry: 'MM/YY'
};

if(inputHolder) {
    inputHolder.addEventListener('input', (e) => {
  displayHolder.innerText = e.target.value.toUpperCase() || defaults.holder;
});
}
if(inputNumber) {

inputNumber.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            let formattedValue = value.replace(/(.{4})/g, '$1 ').trim();
            e.target.value = formattedValue;
            displayNumber.innerText = formattedValue || defaults.number;
        });
    }

        if(inputExpiry) {
inputExpiry.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2);
            }
            
            e.target.value = value;
            displayExpiry.innerText = value || defaults.expiry;
        });


        }

        if(inputBank) {
        inputBank.addEventListener('change', (e) => {
            displayBank.innerText = e.target.value;
        });
        }
        
        if(displayBank) {
        displayBank.innerText = inputBank.value;
        }
        
        if(inputType) {
        inputType.addEventListener('change', (e) => {
            displayType.innerText = e.target.value;
        });
        }
        
         if(displayType) {
        displayType.innerText = inputType.value;
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

if(cardSelect)cardSelect.addEventListener('change', function() {
    const selectedOption = cardSelect.options[cardSelect.selectedIndex];
    const balance = selectedOption.getAttribute('data-balance');
    amountInput.max = balance;
    balanceMsg.innerText = `Max transferable: $${balance}`;
});

const expenceCategory = document.getElementById('category');
const expenceInput = document.getElementById('expenceInput');
const limitmsg = document.getElementById('limitmsg');


if(expenceCategory){
    expenceCategory.addEventListener('change', function() {
    const selectedOption = expenceCategory.options[expenceCategory.selectedIndex];
    expenceInput.max = selectedOption.getAttribute('data-limit');
    limitmsg.innerText = `category limit: $${selectedOption.getAttribute('data-limit')}`;
});
}


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
const recipientCard =document.getElementById('recipientCard')

if(recipientCard){recipientCard.addEventListener('input', function(e) {
    let raw = e.target.value.replace(/\D/g, "").slice(0, 16);
    e.target.value = raw.replace(/(.{4})/g, "$1 ").trim();
});
}

