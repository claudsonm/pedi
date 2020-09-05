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

    /**
     * Todos os códigos de identificação dos eventos com sinal positivo (entrada).
     *
     * @return array|string[]
     */
    public static function entrada(): array
    {
        return [
            self::VENDA_OU_PAGAMENTO, self::AJUSTE_A_CREDITO, self::SALDO_INICIAL,
            self::SALDO_FINAL, self::ENCERRAMENTO_DISPUTA, self::ENCERRAMENTO_PRE_CHARGEBACK,
            self::REMUNERACAO_DE_CONTA,
        ];
    }

    /**
     * Todos os códigos de identificação dos eventos com sinal negativo (saída).
     *
     * @return array|string[]
     */
    public static function saida(): array
    {
        return [
            self::AJUSTE_A_DEBITO, self::TRANSFERENCIA_OUTROS_BANCOS, self::CHARGEBACK,
            self::CANCELAMENTO, self::ABERTURA_DISPUTA, self::ABERTURA_PRE_CHARGEBACK,
            self::AGENDAMENTO_SAQUE_CIP,
        ];
    }
}
