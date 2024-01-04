<div>
    <div class="messages"></div>
</div>
<script src="https://cdn.socket.io/4.7.2/socket.io.min.js"
    integrity="sha384-mZLF4UVrpi/QTWPA7BjNPEnkIfRFn4ZEO3Qt/HFklTJBj/gBOV8G3HcKn4NfQblz" crossorigin="anonymous">
</script>
<script>
    const socket = io('http://localhost:3000');
    socket.on('chat', (data) => {
        const messages = document.querySelector('.messages')
        const element = document.createElement("div");
        element.appendChild(document.createTextNode(data));
        messages.appendChild(element)
    })
</script>
