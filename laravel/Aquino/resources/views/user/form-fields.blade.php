

    @include('templates.formulario.input', ['label' => 'CPF', 'input' => 'cpf', 'attributes' => ['placeholder' => 'CPF']])
    @include('templates.formulario.input', ['input' => 'name', 'attributes' => ['placeholder' => 'Nome']])
    @include('templates.formulario.input', ['input' => 'phone', 'attributes' => ['placeholder' => 'Telefone']])
    @include('templates.formulario.input', ['input' => 'email', 'attributes' => ['placeholder' => 'E-mail']])
    @include('templates.formulario.password', ['input' => 'password', 'attributes' => ['placeholder' => 'Senha']])