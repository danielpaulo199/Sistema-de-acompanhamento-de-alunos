<?php

namespace Database\Seeders;

use App\Models\SugestaoAtividade;
use Illuminate\Database\Seeder;

class SugestaoAtividadeSeeder extends Seeder
{
    public function run(): void
    {
        $atividades = [
            // LEITURA
            [
                'categoria' => 'leitura',
                'titulo' => 'Leitura em Voz Alta em Duplas',
                'descricao' => 'Alunos leem em duplas alternando parágrafos. O colega acompanha com o dedo e corrige gentilmente.',
                'materiais' => 'Livros paradidáticos, textos impressos',
                'passo_a_passo' => "1. Forme duplas com diferentes níveis de leitura\n2. Defina quem lê primeiro\n3. Um lê enquanto o outro acompanha\n4. Troquem a cada parágrafo\n5. Ao final, resumam o que leram",
                'duracao_minutos' => 30,
                'nivel_dificuldade' => 'baixo',
            ],
            [
                'categoria' => 'leitura',
                'titulo' => 'Bingo de Palavras',
                'descricao' => 'Crie cartelas de bingo com palavras trabalhadas. O professor lê a definição e os alunos marcam a palavra correta.',
                'materiais' => 'Cartelas impressas, marcadores, lista de palavras',
                'passo_a_passo' => "1. Prepare cartelas com 9 palavras cada\n2. Leia definições ou use a palavra em uma frase\n3. Alunos identificam e marcam a palavra\n4. Primeiro a completar uma linha ganha",
                'duracao_minutos' => 40,
                'nivel_dificuldade' => 'baixo',
            ],
            [
                'categoria' => 'leitura',
                'titulo' => 'Roda de Leitura com Inferências',
                'descricao' => 'Leitura compartilhada com pausas estratégicas para previsões e inferências sobre o texto.',
                'materiais' => 'Livro de literatura infantil',
                'passo_a_passo' => "1. Mostre apenas a capa e peça previsões\n2. Leia até a metade e pause\n3. Faça perguntas: \"O que vai acontecer?\"\n4. Continue e compare com as previsões\n5. Discuta o final",
                'duracao_minutos' => 45,
                'nivel_dificuldade' => 'medio',
            ],

            // ESCRITA
            [
                'categoria' => 'escrita',
                'titulo' => 'Diário do Dia',
                'descricao' => 'Alunos escrevem diariamente sobre algo que viveram. Foco na escrita livre sem correção imediata.',
                'materiais' => 'Caderno de diário, caneta colorida',
                'passo_a_passo' => "1. Reserve 10 minutos no início da aula\n2. Proponha um tema ou deixe livre\n3. Alunos escrevem sem medo de errar\n4. Compartilhamento voluntário\n5. Valorize o conteúdo, não a forma",
                'duracao_minutos' => 15,
                'nivel_dificuldade' => 'baixo',
            ],
            [
                'categoria' => 'escrita',
                'titulo' => 'Relato de Experiência Pessoal',
                'descricao' => 'Nesta atividade, você deverá escrever um pequeno texto contando uma experiência marcante que viveu recentemente. O objetivo é praticar a escrita de forma livre, organizando ideias e desenvolvendo a comunicação escrita.',
                'materiais' => 'Caderno ou folha A4, caneta ou editor de texto',
                'passo_a_passo' => "1. Escolha uma experiência real que aconteceu com você nos últimos dias\n2. Escreva um texto entre 15 e 20 linhas\n3. Descreva onde aconteceu, quem estava presente e como você se sentiu\n4. Organize o texto com início, meio e fim\n5. Revise apenas para garantir que o texto esteja legível\n6. Traga a atividade pronta no próximo dia de aula",
                'duracao_minutos' => 20,
                'nivel_dificuldade' => 'baixo',
            ],
            [
                'categoria' => 'escrita',
                'titulo' => 'Reescrita de Histórias',
                'descricao' => 'Alunos reescrevem contos conhecidos mudando personagens, época ou final. Desenvolve criatividade e fluência.',
                'materiais' => 'Conto original impresso, folhas pautadas',
                'passo_a_passo' => "1. Leia um conto clássico juntos\n2. Identifique elementos: personagens, lugar, tempo, conflito\n3. Peça para trocar um elemento\n4. Alunos reescrevem a história modificada\n5. Compartilhe as versões",
                'duracao_minutos' => 60,
                'nivel_dificuldade' => 'medio',
            ],
            [
                'categoria' => 'escrita',
                'titulo' => 'Completar Histórias com Figuras',
                'descricao' => 'Sequência de imagens serve como roteiro para criação textual. Reduz a angústia do papel em branco.',
                'materiais' => 'Sequência de 4-6 imagens impressas, folha de resposta',
                'passo_a_passo' => "1. Distribua a sequência de imagens\n2. Alunos ordenam as imagens\n3. Criam frases para cada imagem\n4. Ligam as frases com conectivos\n5. Revisam e passam a limpo",
                'duracao_minutos' => 45,
                'nivel_dificuldade' => 'baixo',
            ],

            // MATEMATICA
            [
                'categoria' => 'matematica',
                'titulo' => 'Mercadinho da Sala',
                'descricao' => 'Simulação de compra e venda com dinheiro fictício. Trabalha operações, troco e problemas do cotidiano.',
                'materiais' => 'Embalagens de produtos, dinheiro de brinquedo ou impresso, etiquetas',
                'passo_a_passo' => "1. Monte um mercadinho com produtos etiquetados\n2. Distribua dinheiro fictício para cada aluno\n3. Alunos compram e o vendedor calcula o troco\n4. Reveze os papéis\n5. Registre as operações no caderno",
                'duracao_minutos' => 50,
                'nivel_dificuldade' => 'medio',
            ],
            [
                'categoria' => 'matematica',
                'titulo' => 'Caça ao Erro de Matemática',
                'descricao' => 'Apresente contas com erros propositais. Alunos identificam, corrigem e explicam o erro.',
                'materiais' => 'Atividade impressa com operações erradas',
                'passo_a_passo' => "1. Distribua a folha com operações\n2. Diga que todas têm pelo menos um erro\n3. Alunos resolvem novamente e comparam\n4. Marcam onde está o erro e o tipo\n5. Discussão coletiva das correções",
                'duracao_minutos' => 35,
                'nivel_dificuldade' => 'medio',
            ],
            [
                'categoria' => 'matematica',
                'titulo' => 'Tangram e Frações',
                'descricao' => 'Uso do tangram para visualizar frações e proporções de forma concreta e lúdica.',
                'materiais' => 'Tangram (impresso ou em cartolina), régua, lápis de cor',
                'passo_a_passo' => "1. Monte o tangram completo\n2. Pergunte: que fração do total é cada peça?\n3. Alunos medem e calculam\n4. Formem figuras usando metade das peças\n5. Registrem as descobertas",
                'duracao_minutos' => 40,
                'nivel_dificuldade' => 'medio',
            ],

            // INTERPRETACAO
            [
                'categoria' => 'interpretacao',
                'titulo' => 'Mapa Mental do Texto',
                'descricao' => 'Após leitura, alunos constroem mapa mental com personagens, local, tempo e problema/solução.',
                'materiais' => 'Texto, folha grande, canetas coloridas',
                'passo_a_passo' => "1. Leia o texto com a turma\n2. Explique a estrutura do mapa mental\n3. No centro: título do texto\n4. Ramos: personagens, lugar, tempo, problema, solução\n5. Complete com palavras e desenhos",
                'duracao_minutos' => 40,
                'nivel_dificuldade' => 'medio',
            ],
            [
                'categoria' => 'interpretacao',
                'titulo' => 'Perguntas em Níveis',
                'descricao' => 'Trabalhe questões em 3 níveis: literal (no texto), inferencial (nas entrelinhas) e crítica (além do texto).',
                'materiais' => 'Texto impresso, cartões coloridos com perguntas',
                'passo_a_passo' => "1. Codifique as perguntas por cores (3 níveis)\n2. Leia o texto coletivamente\n3. Comece pelas perguntas literais\n4. Avance para as inferenciais\n5. Encerre com as críticas/reflexivas",
                'duracao_minutos' => 45,
                'nivel_dificuldade' => 'alto',
            ],

            // CALCULO_MENTAL
            [
                'categoria' => 'calculo_mental',
                'titulo' => 'Quiz de Cálculo Mental',
                'descricao' => 'Competição amigável com operações para resolver mentalmente em tempo limitado.',
                'materiais' => 'Quadro branco, cronômetro, lousa individual ou folhas',
                'passo_a_passo' => "1. Organize a turma em equipes\n2. Apresente uma conta por vez\n3. 30 segundos para resolver mentalmente\n4. Equipe que acertar primeiro marca ponto\n5. Discuta as estratégias usadas",
                'duracao_minutos' => 30,
                'nivel_dificuldade' => 'medio',
            ],

            // ATENCAO
            [
                'categoria' => 'atencao',
                'titulo' => 'Labirintos e Atividades de Trilha',
                'descricao' => 'Resolução de labirintos e desafios de trilha desenvolvem atenção, planejamento e perseverança.',
                'materiais' => 'Labirintos impressos em diferentes níveis de dificuldade',
                'passo_a_passo' => "1. Comece com labirintos simples\n2. Oriente a usar lápis e apagador\n3. Ensine a estratégia de visualizar antes de traçar\n4. Aumente a complexidade gradualmente\n5. Cronometrar aumenta o desafio",
                'duracao_minutos' => 20,
                'nivel_dificuldade' => 'baixo',
            ],
            [
                'categoria' => 'atencao',
                'titulo' => 'Método Pomodoro Adaptado',
                'descricao' => 'Ciclos de 15 minutos de foco + 5 minutos de pausa. Treina a atenção de forma gradual.',
                'materiais' => 'Cronômetro visível, atividades sequenciadas',
                'passo_a_passo' => "1. Explique o conceito de ciclos de foco\n2. Configure o timer para 15 minutos\n3. Alunos trabalham em silêncio\n4. 5 minutos de pausa (levantar, beber água)\n5. Novo ciclo começa",
                'duracao_minutos' => 40,
                'nivel_dificuldade' => 'baixo',
            ],

            // COMPORTAMENTO
            [
                'categoria' => 'comportamento',
                'titulo' => 'Combinados da Turma',
                'descricao' => 'Construção coletiva das regras da sala. Alunos se comprometem mais com regras que ajudaram a criar.',
                'materiais' => 'Cartaz grande, canetas, adesivos coloridos',
                'passo_a_passo' => "1. Proponha a discussão: que sala queremos ter?\n2. Cada aluno fala uma ideia\n3. Agrupem ideias semelhantes\n4. Votem nas regras mais importantes\n5. Assinem o cartaz como compromisso",
                'duracao_minutos' => 45,
                'nivel_dificuldade' => 'baixo',
            ],

            // SOCIALIZACAO
            [
                'categoria' => 'socializacao',
                'titulo' => 'Projeto em Grupo Rotativo',
                'descricao' => 'Grupos trocam a cada semana, fazendo todos interagirem com todos. Desenvolve habilidades sociais.',
                'materiais' => 'Material do projeto em andamento',
                'passo_a_passo' => "1. Defina grupos de 4 alunos por sorteio\n2. Cada grupo tem uma tarefa dentro do projeto\n3. A cada semana, reorganize os grupos\n4. Cada aluno explica o que aprendeu\n5. Construam o projeto colaborativamente",
                'duracao_minutos' => 60,
                'nivel_dificuldade' => 'medio',
            ],

            // CRIATIVIDADE
            [
                'categoria' => 'criatividade',
                'titulo' => 'Invenção de Jogos',
                'descricao' => 'Alunos inventam um jogo com regras, material e objetivo. Desenvolve criatividade, escrita e raciocínio.',
                'materiais' => 'Materiais variados: cartolina, dados, pinos, canetas',
                'passo_a_passo' => "1. Analise jogos conhecidos (estrutura, regras)\n2. Grupos propõem um novo jogo\n3. Escrevem as regras\n4. Criam o material necessário\n5. Testam com outra equipe",
                'duracao_minutos' => 90,
                'nivel_dificuldade' => 'alto',
            ],

            // RACIOCINIO_LOGICO
            [
                'categoria' => 'raciocinio_logico',
                'titulo' => 'Desafios de Lógica com Detetive',
                'descricao' => 'Problemas de lógica narrados como casos de detetive. Alunos usam pistas para chegar à conclusão.',
                'materiais' => 'Cartões com pistas, folha de anotações',
                'passo_a_passo' => "1. Apresente o mistério a ser resolvido\n2. Distribua pistas em cartões numerados\n3. Alunos organizam as informações\n4. Constroem o raciocínio passo a passo\n5. Revelam e justificam a resposta",
                'duracao_minutos' => 45,
                'nivel_dificuldade' => 'alto',
            ],

            // ORALIDADE
            [
                'categoria' => 'oralidade',
                'titulo' => 'Roda de Notícias',
                'descricao' => 'Alunos apresentam uma notícia da semana em 2 minutos. Desenvolve fala em público e síntese.',
                'materiais' => 'Notícias impressas ou anotações',
                'passo_a_passo' => "1. Cada aluno escolhe uma notícia na semana\n2. Prepara um resumo de 2 minutos\n3. Na roda, apresenta para a turma\n4. A turma faz uma pergunta\n5. Aluno responde e passa a vez",
                'duracao_minutos' => 30,
                'nivel_dificuldade' => 'medio',
            ],

            // CIENCIAS
            [
                'categoria' => 'ciencias',
                'titulo' => 'Experimento: Vulcão de Bicarbonato',
                'descricao' => 'Experimento clássico que demonstra reação química de forma visual. Gera interesse e curiosidade.',
                'materiais' => 'Bicarbonato de sódio, vinagre, corante, argila ou garrafa',
                'passo_a_passo' => "1. Construa o vulcão com argila ou copo\n2. Adicione bicarbonato no interior\n3. Adicione corante vermelho\n4. Despeje vinagre e observe\n5. Registre e explique o fenômeno",
                'duracao_minutos' => 50,
                'nivel_dificuldade' => 'baixo',
            ],
        ];

        foreach ($atividades as $atividade) {
            SugestaoAtividade::create($atividade);
        }
    }
}
