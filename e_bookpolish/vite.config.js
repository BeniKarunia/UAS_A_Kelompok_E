import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import nightwatchPlugin from 'vite-plugin-nightwatch'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    nightwatchPlugin()
  ]
})

// plugins: [
//   vue({
//     template: {
//       compilerOptions: {
//         isCustomElement: (tag) => {
//           return tag.startsWith('ion-'),
//           nightwatchPlugin() // (return true)
//         }
//       }
//     }
//   })
// ]
// })
