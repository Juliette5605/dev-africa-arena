
<style>
.chat-bubble {
    position: fixed; bottom: 28px; right: 28px; z-index: 9999;
    width: 58px; height: 58px; border-radius: 50%;
    background: linear-gradient(135deg,#f39c12,#e67e22);
    box-shadow: 0 8px 28px rgba(243,156,18,0.4);
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    transition: 0.3s; border: none;
}
.chat-bubble:hover { transform: scale(1.1); }
.chat-bubble svg { width: 26px; height: 26px; fill: #fff; }

.chat-window {
    position: fixed; bottom: 100px; right: 28px; z-index: 9998;
    width: 360px; max-height: 520px;
    background: #fff; border-radius: 24px;
    box-shadow: 0 24px 64px rgba(0,0,0,0.15);
    display: flex; flex-direction: column;
    overflow: hidden; transition: 0.3s;
    border: 1px solid rgba(243,156,18,0.15);
}
.chat-window.hidden { opacity: 0; pointer-events: none; transform: translateY(20px) scale(0.95); }

.chat-header {
    background: linear-gradient(135deg,#111,#1a1a1a);
    padding: 16px 20px;
    display: flex; align-items: center; gap: 12px;
    border-bottom: 2px solid #f39c12;
}
.chat-header-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: linear-gradient(135deg,#f39c12,#e67e22);
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; flex-shrink: 0;
}
.chat-header-info h6 { color: #fff; font-size: 0.88rem; font-weight: 700; margin: 0; }
.chat-header-info p  { color: rgba(255,255,255,0.5); font-size: 0.72rem; margin: 0; }
.chat-close { margin-left: auto; background: none; border: none; color: rgba(255,255,255,0.4); cursor: pointer; font-size: 1.2rem; padding: 0; }
.chat-close:hover { color: #fff; }

.chat-messages {
    flex: 1; overflow-y: auto; padding: 16px;
    display: flex; flex-direction: column; gap: 10px;
    background: #fafafa;
}
.chat-messages::-webkit-scrollbar { width: 4px; }
.chat-messages::-webkit-scrollbar-thumb { background: #eee; border-radius: 4px; }

.msg { max-width: 82%; padding: 10px 14px; border-radius: 16px; font-size: 0.85rem; line-height: 1.5; }
.msg-bot { background: #fff; border: 1px solid #eee; color: #333; align-self: flex-start; border-bottom-left-radius: 4px; }
.msg-user { background: linear-gradient(135deg,#f39c12,#e67e22); color: #fff; align-self: flex-end; border-bottom-right-radius: 4px; }
.msg-typing { display: flex; gap: 4px; align-items: center; padding: 12px 14px; }
.dot { width: 7px; height: 7px; background: #ddd; border-radius: 50%; animation: bounce 1.2s infinite; }
.dot:nth-child(2) { animation-delay: 0.2s; }
.dot:nth-child(3) { animation-delay: 0.4s; }
@keyframes bounce { 0%,60%,100%{transform:translateY(0)} 30%{transform:translateY(-6px)} }

.chat-suggestions {
    padding: 8px 16px;
    display: flex; gap: 6px; flex-wrap: wrap;
    background: #fafafa; border-top: 1px solid #f0f0f0;
}
.chip {
    background: #fff; border: 1px solid #eee; border-radius: 20px;
    padding: 5px 12px; font-size: 0.75rem; font-weight: 600; color: #555;
    cursor: pointer; transition: 0.2s; white-space: nowrap;
}
.chip:hover { border-color: #f39c12; color: #f39c12; }

.chat-input-row {
    padding: 12px 16px;
    display: flex; gap: 8px;
    background: #fff; border-top: 1px solid #f0f0f0;
}
.chat-input {
    flex: 1; border: 1.5px solid #eee; border-radius: 50px;
    padding: 9px 16px; font-size: 0.85rem; outline: none;
    transition: 0.2s; font-family: inherit;
}
.chat-input:focus { border-color: #f39c12; }
.chat-send {
    width: 38px; height: 38px; border-radius: 50%;
    background: linear-gradient(135deg,#f39c12,#e67e22);
    border: none; cursor: pointer; display: flex;
    align-items: center; justify-content: center;
    flex-shrink: 0; transition: 0.2s;
}
.chat-send:hover { transform: scale(1.08); }
.chat-send svg { width: 16px; height: 16px; fill: #fff; }
</style>


<button class="chat-bubble" onclick="toggleChat()" id="chat-btn" title="Assistant IA DevAfricaArena">
    <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg>
</button>


<div class="chat-window hidden" id="chat-window">
    <div class="chat-header">
        <div class="chat-header-avatar">🤖</div>
        <div class="chat-header-info">
            <h6>Assistant DevAfricaArena</h6>
            <p>Propulsé par DevAfricaArena</p>
        </div>
        <button class="chat-close" onclick="toggleChat()">✕</button>
    </div>

    <div class="chat-messages" id="chat-messages">
        <div class="msg msg-bot">
            Bonjour ! Je suis l'assistant IA de DevAfricaArena. Je peux vous aider sur les candidatures, les partenariats, les dates et bien plus. Que souhaitez-vous savoir ?
        </div>
    </div>

    <div class="chat-suggestions" id="chat-suggestions">
        <span class="chip" onclick="sendChip(this)">Comment candidater ?</span>
        <span class="chip" onclick="sendChip(this)">Dates de l'événement</span>
        <span class="chip" onclick="sendChip(this)">Cash prize</span>
        <span class="chip" onclick="sendChip(this)">Devenir partenaire</span>
    </div>

    <div class="chat-input-row">
        <input class="chat-input" id="chat-input" type="text"
               placeholder="Posez votre question..."
               onkeydown="if(event.key==='Enter') sendMessage()">
        <button class="chat-send" onclick="sendMessage()">
            <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
        </button>
    </div>
</div>

<script>
let chatOpen = false;

function toggleChat() {
    chatOpen = !chatOpen;
    document.getElementById('chat-window').classList.toggle('hidden', !chatOpen);
}

function addMsg(text, isUser) {
    const box = document.getElementById('chat-messages');
    const div = document.createElement('div');
    div.className = 'msg ' + (isUser ? 'msg-user' : 'msg-bot');
    div.textContent = text;
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
}

function showTyping() {
    const box = document.getElementById('chat-messages');
    const div = document.createElement('div');
    div.className = 'msg msg-bot msg-typing'; div.id = 'typing';
    div.innerHTML = '<div class="dot"></div><div class="dot"></div><div class="dot"></div>';
    box.appendChild(div); box.scrollTop = box.scrollHeight;
}
function removeTyping() {
    const t = document.getElementById('typing');
    if (t) t.remove();
}

async function sendMessage() {
    const input = document.getElementById('chat-input');
    const msg = input.value.trim();
    if (!msg) return;
    input.value = '';
    document.getElementById('chat-suggestions').style.display = 'none';

    addMsg(msg, true);
    showTyping();

    try {
        const r = await fetch('<?php echo e(route("chat.public")); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
            body: JSON.stringify({ message: msg })
        });
        const d = await r.json();
        removeTyping();
        addMsg(d.reply || 'Désolé, je n\'ai pas compris. Reformulez votre question.', false);
    } catch(e) {
        removeTyping();
        addMsg('Connexion impossible pour le moment. Réessayez ou contactez-nous directement.', false);
    }
}

function sendChip(el) {
    document.getElementById('chat-input').value = el.textContent;
    sendMessage();
}
</script>
<?php /**PATH C:\Users\USER\Desktop\dev-africa-arena\resources\views/partials/chatbot.blade.php ENDPATH**/ ?>