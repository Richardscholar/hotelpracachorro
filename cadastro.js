const form = document.getElementById('cadastroForm');

form.addEventListener('submit', function(event) {
  event.preventDefault(); // previne o envio padrão

  const nome = document.getElementById('nome').value.trim();
  const email = document.getElementById('email').value.trim();
  const senha = document.getElementById('senha').value.trim();
  const confirmarSenha = document.getElementById('confirmarSenha').value.trim();

  // Valida campos vazios
  if (!nome || !email || !senha || !confirmarSenha) {
    alert('⚠️ Por favor, preencha todos os campos!');
    return;
  }

  // Valida email
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert('⚠️ Por favor, digite um email válido!');
    return;
  }

  // Valida tamanho da senha
  if (senha.length < 6) {
    alert('⚠️ A senha deve ter pelo menos 6 caracteres!');
    return;
  }

  // Valida se as senhas coincidem
  if (senha !== confirmarSenha) {
    alert('⚠️ As senhas não coincidem!');
    return;
  }

  // Cadastro concluído
  alert(`🎉 Cadastro realizado com sucesso!\nBem-vindo(a), ${nome}! 🐾`);

  form.reset(); // limpa formulário

  // Redireciona para login após 1,5s
  setTimeout(() => {
    window.location.href = 'login.html';
  }, 1500);
});

// Efeitos de foco nos inputs (opcional)
document.querySelectorAll('input').forEach(input => {
  input.addEventListener('focus', () => {
    input.parentElement.style.transform = 'scale(1.02)';
  });
  input.addEventListener('blur', () => {
    input.parentElement.style.transform = 'scale(1)';
  });
});