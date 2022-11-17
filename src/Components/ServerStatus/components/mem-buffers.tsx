import { observer } from 'mobx-react-lite'
import { FC } from 'react'
import { CardGrid } from '../../Card/components/card-grid'
import { gettext } from '../../Language'
import { ProgressBar } from '../../ProgressBar/components'
import { ServerStatusStore } from '../stores'
export const MemBuffers: FC = observer(() => {
  const { max, value } = ServerStatusStore.memBuffers
  return (
    <CardGrid
      title={gettext(
        'Buffers are in-memory block I/O buffers. They are relatively short-lived. Prior to Linux kernel version 2.4, Linux had separate page and buffer caches. Since 2.4, the page and buffer cache are unified and Buffers is raw disk blocks not represented in the page cache—i.e., not file data.',
      )}
      name={gettext('Memory buffers')}
      lg={2}
    >
      <ProgressBar value={value} max={max} isCapacity />
    </CardGrid>
  )
})
