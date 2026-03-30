# 🎒 Sistema de Acompanhamento de Alunos

Sistema web desenvolvido em Laravel para acompanhamento pedagógico de alunos.
Permite cadastrar alunos, registrar suas dificuldades e qualidades, e oferece sugestões de atividades personalizadas.

---

## 📋 Funcionalidades

- ✅ **Cadastro de alunos** com foto, data de nascimento e informações do responsável
- ✅ **Perfil completo de cada aluno** com histórico de dificuldades e qualidades
- ✅ **Registro de características** por categoria (Leitura, Escrita, Matemática, etc.) e nível (Baixo, Médio, Alto)
- ✅ **Sugestões automáticas de atividades** baseadas nas dificuldades cadastradas
- ✅ **Painel das turmas** com visão geral de todos os alunos
- ✅ **Horários das turmas** com indicação das aulas ministradas e de planejamento

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