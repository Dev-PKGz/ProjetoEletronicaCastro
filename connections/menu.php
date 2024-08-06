<?php
            // Array que define os itens do menu com níveis de acesso
            $menuItems = [
                'Home' => ['icon' => 'bi-house-door', 'link' => '../home', 'sectors' => ['Dev', 'Ven', 'ecom', 'Adm']],
                'Dashboard' => ['icon' => 'bi-columns-gap', 'link' => '#', 'sectors' => ['Dev', 'Adm']],
                'Sistema Senha' => ['icon' => 'bi-pass', 'link' => '../painel_senhas', 'sectors' => ['Dev', 'Ven', 'ecom']],
                'Painel Administrador' => ['icon' => 'bi-gear', 'link' => '../manager', 'sectors' => ['Dev', 'Adm']],
                'Conta' => ['icon' => 'bi-person-circle', 'link' => '#', 'sectors' => ['Dev', 'Ven', 'ecom', 'Adm']]            
            ];

            // Renderiza os itens do menu com base no nível de acesso
            foreach ($menuItems as $name => $item) {
                if (has_access($item['sectors'])) {
                    echo '<li class="item-menu">';
                    echo '<a href="' . $item['link'] . '"';
                    if (isset($item['id'])) echo ' id="' . $item['id'] . '"';
                    echo '>';
                    echo '<span class="icon"><i class="bi ' . $item['icon'] . '"></i></span>';
                    echo '<span class="txt-link">' . $name . '</span>';
                    echo '</a>';
                    echo '</li>';
                }
            }
            ?>