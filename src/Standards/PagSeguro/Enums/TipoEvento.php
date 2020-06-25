<?php

namespace Claudsonm\Pedi\Standards\PagSeguro\Enums;

class TipoEvento
{
    const VENDA_OU_PAGAMENTO = '01';
    const AJUSTE_A_CREDITO = '02';
    const AJUSTE_A_DEBITO = '03';
    const TRANSFERENCIA_OUTROS_BANCOS = '04';
    const CHARGEBACK = '05';
    const CANCELAMENTO = '06';
    const SALDO_INICIAL = '07';
    const SALDO_FINAL = '08';
    const ABERTURA_DISPUTA = '09';
    const ENCERRAMENTO_DISPUTA = '10';
    const ABERTURA_PRE_CHARGEBACK = '11';
    const ENCERRAMENTO_PRE_CHARGEBACK = '12';
    const AGENDAMENTO_SAQUE_CIP = '14';
    const SAQUE_APROVADO_CIP = '15';
    const REMUNERACAO_DE_CONTA = '16';
}
