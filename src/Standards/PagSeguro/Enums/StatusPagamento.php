<?php

namespace Claudsonm\Pedi\Standards\PagSeguro\Enums;

class StatusPagamento
{
    const AGENDADO = 1;
    const PAGO = 2;
    const DISPONIVEL = 3;
    const DISPONIVEL_ANTECIPACAO = 4;
    const SOLICITADO = 5;

    /**
     * Status nos quais os recursos dos pagamentos estão disponíveis para uso
     * na conta do usuário.
     *
     * @return array|int[]
     */
    public static function disponivel(): array
    {
        return [
            self::PAGO, self::DISPONIVEL, self::DISPONIVEL_ANTECIPACAO,
        ];
    }

    /**
     * Status nos quais os recursos dos pagamentos ainda não estão disponíveis
     * para uso na conta do usuário.
     *
     * @return array|int[]
     */
    public static function indisponivel(): array
    {
        return [
            self::AGENDADO, self::SOLICITADO,
        ];
    }
}
