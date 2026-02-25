# 🎒 Sistema de Acompanhamento de Alunos — 5º Ano

Sistema web desenvolvido em Laravel para acompanhamento pedagógico de alunos do 5º ano.
Permite cadastrar alunos, registrar suas dificuldades e qualidades, e recebe sugestões de atividades personalizadas.

---

## 📋 Funcionalidades

- ✅ **Cadastro de alunos** com foto, data de nascimento e informações do responsável
- ✅ **Perfil completo de cada aluno** com histórico de dificuldades e qualidades
- ✅ **Registro de características** por categoria (Leitura, Escrita, Matemática, etc.) e nível (Baixo, Médio, Alto)
- ✅ **Sugestões automáticas de atividades** baseadas nas dificuldades cadastradas
- ✅ **Painel da turma** com visão geral de todos os alunos

---

## 🚀 Instalação passo a passo

### Pré-requisitos
- PHP 8.1 ou superior → [php.net/downloads](https://www.php.net/downloads)
- Composer → [getcomposer.org](https://getcomposer.org)
- Git (opcional)

### 1. Extraia os arquivos do projeto

Coloque a pasta `escola5ano` em qualquer lugar no seu computador.

### 2. Abra o terminal na pasta do projeto

```bash
cd caminho/para/escola5ano
```

### 3. Instale as dependências

```bash
composer install
```

### 4. Configure o arquivo de ambiente

```bash
# Windows:
copy .env.example .env

# Mac / Linux:
cp .env.example .env
```

### 5. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 6. Crie o banco de dados SQLite

```bash
# Windows:
type nul > database\database.sqlite

# Mac / Linux:
touch database/database.sqlite
```

### 7. Execute as migrações e popule as sugestões de atividades

```bash
php artisan migrate --seed
```

### 8. Crie o link para armazenamento de fotos

```bash
php artisan storage:link
```

### 9. Inicie o servidor

```bash
php artisan serve
```

### 10. Acesse no navegador

```
http://localhost:8000
```

---

## 🗂️ Categorias de Dificuldades/Qualidades disponíveis

| Categoria | Sugestões Automáticas |
|-----------|----------------------|
| Leitura | ✅ 3 atividades |
| Escrita | ✅ 3 atividades |
| Matemática | ✅ 3 atividades |
| Interpretação de Texto | ✅ 2 atividades |
| Cálculo Mental | ✅ 1 atividade |
| Atenção / Concentração | ✅ 2 atividades |
| Comportamento | ✅ 1 atividade |
| Socialização | ✅ 1 atividade |
| Criatividade | ✅ 1 atividade |
| Raciocínio Lógico | ✅ 1 atividade |
| Oralidade | ✅ 1 atividade |
| Ciências | ✅ 1 atividade |
| História e Geografia | (sem sugestão pré-cadastrada) |
| Artes | (sem sugestão pré-cadastrada) |

---

## 💡 Como usar

1. **Acesse** `http://localhost:8000`
2. **Cadastre os alunos** clicando em "➕ Novo Aluno"
3. **Clique em um aluno** para abrir o perfil completo
4. **Adicione dificuldades e qualidades** usando o botão "Adicionar Dificuldade ou Qualidade"
5. **Veja as sugestões** na aba "💡 Sugestões de Atividades" — elas aparecem automaticamente baseadas nas dificuldades cadastradas!

---

## 🛠️ Problemas comuns

**Erro: "Could not find driver"**
→ Habilite a extensão `php_pdo_sqlite` no seu php.ini

**Erro: "Storage link already exists"**
→ Ignore, já está configurado

**Fotos não aparecem**
→ Certifique-se de que executou `php artisan storage:link`

---

## 📁 Estrutura do Banco de Dados

- **alunos** — Dados dos alunos
- **caracteristicas** — Dificuldades e qualidades de cada aluno
- **sugestoes_atividades** — Banco de atividades pré-cadastradas por categoria
