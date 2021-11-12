# -*- coding: utf-8 -*-

from cmk.gui.plugins.views.perfometers.check_mk import (
    perfometer_fanspeed,
    perfometer_temperature_multi,
    perfometer_voltage,
)

perfometers["check_mk-lmsensors.fan"]  = perfometer_fanspeed
perfometers["check_mk-lmsensors.temp"] = perfometer_temperature_multi
perfometers["check_mk-lmsensors.volt"] = perfometer_voltage
