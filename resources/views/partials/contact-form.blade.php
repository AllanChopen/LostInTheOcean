<div id="contact-modal" class="contact-modal" style="display:none;">
  <div class="contact-panel">
    <button class="contact-close" aria-label="Cerrar">&times;</button>
    <h3 class="contact-title">Contacto</h3>
    <p class="contact-sub">Escríbenos un mensaje y te responderemos pronto.</p>

    <form class="contact-form" id="contact-form" method="POST" action="/contact">
      @csrf
      <div class="form-row">
        <label class="sr-only">Nombre</label>
        <input name="name" type="text" placeholder="Tu nombre" required />
      </div>

      <div class="form-row">
        <label class="sr-only">Email</label>
        <input name="email" type="email" placeholder="Tu correo" required />
      </div>

      <div class="form-row">
        <label class="sr-only">Teléfono</label>
        <input name="phone" type="tel" placeholder="Teléfono (opcional)" />
      </div>

      <div class="form-row">
        <label class="sr-only">Mensaje</label>
        <textarea name="message" placeholder="Tu mensaje" required rows="5"></textarea>
      </div>

      <div class="form-actions" style="display:flex;gap:.6rem;align-items:center;justify-content:flex-end;margin-top:10px;">
        <div class="form-message" style="flex:1;color:var(--text-faint);"></div>
        <button type="submit" class="btn">Enviar</button>
      </div>
    </form>
  </div>
</div>

<style>
/* Contact modal styles aligned with site theme */
.contact-modal{position:fixed;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(8,6,10,0.65);z-index:120;padding:20px}
.contact-panel{width:100%;max-width:520px;background:linear-gradient(150deg,#1e151c,#130c13);border:1px solid rgba(167,148,148,.12);padding:20px;border-radius:12px;color:var(--text);position:relative}
.contact-close{position:absolute;right:12px;top:10px;border:0;background:transparent;color:var(--text);font-size:26px;cursor:pointer}
.contact-title{font-family:var(--font-title);margin:0 0 6px 0;background:var(--gradient-brand);-webkit-background-clip:text;color:transparent}
.contact-sub{color:var(--text-faint);margin-bottom:12px}
.contact-form input, .contact-form textarea{width:100%;padding:10px 12px;border-radius:8px;border:1px solid rgba(167,148,148,.08);background:rgba(255,255,255,0.02);color:var(--text);margin-bottom:10px}
.contact-form input:focus, .contact-form textarea:focus{box-shadow:var(--focus)}
.form-message{font-size:.92rem;padding-left:6px}
</style>

<script>
// Hook to open/close modal and to support opening from header link
document.addEventListener('DOMContentLoaded', function(){
  const modal = document.getElementById('contact-modal');
  const closeBtn = modal?.querySelector('.contact-close');
  const form = modal?.querySelector('.contact-form');
  const formMessage = modal?.querySelector('.form-message');

  function openModal(msg){
    if (!modal) return;
    modal.style.display = 'flex';
    if (typeof msg === 'string' && formMessage) formMessage.textContent = msg;
    // focus first input
    const first = modal.querySelector('input[name="name"]'); if (first) first.focus();
  }
  function closeModal(){ if (!modal) return; modal.style.display = 'none'; }

  closeBtn?.addEventListener('click', closeModal);
  modal?.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });

  // Open from header/menu link(s)
  document.querySelectorAll('#open-contact, a.open-contact').forEach(el => {
    el.addEventListener('click', function(e){
      e.preventDefault();
      // Delay slightly so mobile nav can close
      setTimeout(() => openModal(), 120);
    });
  });

  // If form exists, rely on existing script.js handlers; keep fetch fallback
  if (!form) return;
  // keep fetch behavior for graceful AJAX if script.js not handling it
  form.addEventListener('submit', async function(e){
    e.preventDefault();
    const data = new FormData(form);
    const btn = form.querySelector('button[type=submit]');
    const orig = btn?.textContent || '';
    if (btn) { btn.disabled = true; btn.textContent = 'Enviando...'; }
    try {
      const res = await fetch(form.action, { method: form.method || 'POST', headers: { 'Accept': 'application/json' }, body: data });
      const json = await res.json();
      if (formMessage) formMessage.textContent = json.message || 'Enviado.';
      form.reset();
    } catch (err) {
      if (formMessage) formMessage.textContent = 'Error al enviar. Intenta otra vez.';
    } finally { if (btn) { btn.disabled = false; btn.textContent = orig; } }
  });
});
</script>