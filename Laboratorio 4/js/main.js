document.addEventListener('DOMContentLoaded', function() {
    const btnRedactar = document.getElementById('btnRedactar');
    const composeForm = document.getElementById('composeForm');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnInbox = document.getElementById('btnInbox');
    const btnSent = document.getElementById('btnSent');
    const btnEnviar = document.getElementById('btnEnviar');
    const emailList = document.getElementById('emailList');

    loadEmails('entrada');

    btnRedactar.addEventListener('click', () => {
        composeForm.classList.add('active');
    });

    btnCancelar.addEventListener('click', () => {
        composeForm.classList.remove('active');
        document.getElementById('toEmail').value = '';
        document.getElementById('subject').value = '';
        document.getElementById('message').value = '';
    });

    btnInbox.addEventListener('click', () => {
        setActiveButton(btnInbox);
        loadEmails('entrada');
    });

    btnSent.addEventListener('click', () => {
        setActiveButton(btnSent);
        loadEmails('salida');
    });

    btnEnviar.addEventListener('click', (e) => {
        e.preventDefault();
        sendEmail();
    });
});

function setActiveButton(activeBtn) {
    document.querySelectorAll('.sidebar button').forEach(btn => {
        btn.classList.remove('active');
    });
    activeBtn.classList.add('active');
}

function loadEmails(bandeja) {
    fetch(`php/get_emails.php?bandeja=${bandeja}`)
        .then(response => response.json())
        .then(data => {
            const emailList = document.getElementById('emailList');
            emailList.innerHTML = '';
            
            data.forEach(email => {
                const row = createEmailRow(email);
                emailList.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
}

function createEmailRow(email) {
    const tr = document.createElement('tr');
    const estadoClass = email.estado === 'P' ? 'estado-pendiente' : 'estado-enviado';
    const estadoText = email.estado === 'P' ? 'Pendiente' : 'Enviado';
    
    tr.innerHTML = `
        <td>${email.correo}</td>
        <td>${email.asunto}</td>
        <td class="${estadoClass}">${estadoText}</td>
        <td><button class="ver-btn" onclick="viewEmail(${email.id})">Ver</button></td>
    `;
    
    return tr;
}

function viewEmail(id) {
    fetch(`php/get_email.php?id=${id}`)
        .then(response => response.json())
        .then(email => {
            document.getElementById('modalSubject').textContent = email.asunto;
            document.getElementById('modalFrom').textContent = email.correo;
            document.getElementById('modalMessage').textContent = email.mensaje;
            
            const modal = new bootstrap.Modal(document.getElementById('emailModal'));
            modal.show();
        })
        .catch(error => console.error('Error:', error));
}

function sendEmail() {
    const formData = {
        correo: document.getElementById('toEmail').value,
        asunto: document.getElementById('subject').value,
        mensaje: document.getElementById('message').value
    };

    fetch('php/send_email.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Mensaje enviado correctamente');
            document.getElementById('composeForm').classList.remove('active');
            document.getElementById('toEmail').value = '';
            document.getElementById('subject').value = '';
            document.getElementById('message').value = '';
            loadEmails('salida');
        } else {
            alert('Error al enviar el mensaje');
        }
    })

    .catch(error => console.error('Error:', error));
}